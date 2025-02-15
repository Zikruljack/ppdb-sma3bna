<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

use App\Models\PpdbUser;
use App\Models\NilaiRapor;

use App\DataTables\PesertaPPDBDataTable;

class AdminPpdbController extends Controller
{
    // Display a listing of the resource.
    public function index(PesertaPPDBDataTable $dataTables)
    {
        $ppdbs = PpdbUser::all();
        return $dataTables->render('dashboard.ppdb.peserta', compact('ppdbs'));
    }

    // public function detailPeserta($id = null){
    //     $user = auth()->user();

    //     $data = PpdbUser::where('status', 'Final')->where('id', $id)->first();
    //     $nilaiRapor = NilaiRapor::where('user_id', $user->id)
    //                 ->with('mapel')
    //                 ->orderBy('semester')
    //                 ->get()
    //                 ->groupBy('semester');
    //     $pdf = PDF::loadView('dashboard.ppdb.pdf', compact('data', 'nilaiRapor'));

    //     // return view('dashboard.ppdb.pdf', compact('userPpdb'));
    //     return $pdf->stream('formulir-ppdb.pdf');
    // }

    public function detailPeserta($id = null){
        $data = PpdbUser::where('status', 'Final')->where('id', $id)->first();
        $provinsi = DB::table('indonesia_provinces')->select('name')->where('code', $data->provinsi)->first();
        $kabkota = DB::table('indonesia_cities')->select('name')->where('code', $data->kabupaten_kota)->first();
        $kecamatan = DB::table('indonesia_districts')->select('name')->where('code', $data->kecamatan)->first();
        // dd($provinsi);
        $nilaiRapor = NilaiRapor::where('user_id', $data->user_id)
                ->with('mapel')
                ->orderBy('semester')
                ->get()
                ->groupBy('semester');
        return view('dashboard.ppdb.detail', compact('data', 'nilaiRapor', 'provinsi', 'kabkota', 'kecamatan'));
    }

    //validasi ppdb
    // public function validasi($id){
    //     $ppdb = PpdbUser::find($id);
    //     $ppdb->status = 'valid';
    //     $ppdb->save();
    //     return redirect()->route('admin.ppdb.index');

    // }

    public function validasi($id)
    {
        $user = PpdbUser::find($id);
        $userMail = User::where('id', $user->user_id)->first();
        try {
            DB::beginTransaction();
            $user->update(['status' => 'Valid']);
            // Tambahkan logika validasi di sini

            // Kirim email ke user
            \Mail::to($userMail->email)->send(new \App\Mail\PPDBAcceptanceLetter($user));

            DB::commit();
            return redirect()->route('admin.ppdb.index')->with('success', 'Data berhasil disimpan dan email telah dikirim');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error("message:" . $e->getMessage());
            return redirect()->route('admin.ppdb.index')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function downloadKartu($id)
    {
        $data = PpdbUser::where('status', 'Valid')->where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        try {
            $pdf = Pdf::loadView('dashboard.ppdb.kartuujian', compact('data'))
                ->setPaper('A4', 'landscape'); // 10cm x 14cm

            return $pdf->download('kartuujian-' . $data->nama_lengkap . '.pdf');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
