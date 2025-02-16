<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\PpdbUser;
use App\Models\Mapel;
use App\Models\BerkasPpdb;
use App\Models\Sertifikat;
use App\Models\NilaiRapor;
use App\Models\User;

use App\DataTables\PesertaPPDBDataTable;
use App\DataTables\PesertaLulusDataTable;

class AdminPpdbController extends Controller
{
    // Display a listing of the resource.
    public function index(PesertaPPDBDataTable $dataTables)
    {
        $ppdbs = PpdbUser::all();
        return $dataTables->render('dashboard.ppdb.peserta', compact('ppdbs'));
    }

    public function pesertaLulus(PesertaLulusDataTable $dataTables)
    {
        return $dataTables->render('dashboard.ppdb.pesertalulus');
    }

    public function detailPeserta($id){
        $ppdbUser = PpdbUser::whereNotIn('status', ['Tidak Valid', 'Pendaftar'])->where('id', $id)->first();
        // dd($ppdbUser);
        $provinsi = DB::table('indonesia_provinces')->select('name')->where('code', $ppdbUser->provinsi)->first();
        $kabkota = DB::table('indonesia_cities')->select('name')->where('code', $ppdbUser->kabupaten_kota)->first();
        $kecamatan = DB::table('indonesia_districts')->select('name')->where('code', $ppdbUser->kecamatan)->first();

        $berkasPendukung = BerkasPpdb::where('user_id', $ppdbUser->user_id)->first();
        $sertifikat = Sertifikat::where('berkas_id', $berkasPendukung->id)->get();
        // dd($provinsi);
        $nilaiRapor = NilaiRapor::where('user_id', $ppdbUser->user_id)
                ->with('mapel')
                ->orderBy('semester')
                ->get()
                ->groupBy('semester');
        return view('dashboard.ppdb.detail', compact('ppdbUser', 'nilaiRapor', 'provinsi', 'kabkota', 'kecamatan', 'sertifikat', 'berkasPendukung'));
    }

    //validasi ppdb
    public function validasiView($id){
        $ppdbUser = PpdbUser::where('id', $id)->first();
        return view('dashboard.ppdb.validasi', compact('ppdbUser'));

    }

    public function validasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:valid,tidak_valid',
            'note_validasi' => 'nullable|string',
        ],[
            'status.required' => 'Status validasi harus dipilih.',
            'note_validasi' => 'Note validasi harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();


        $data = PpdbUser::find($id);
        $userMail = User::where('id', $data->user_id)->first();
        try {
            DB::beginTransaction();
            $lastUser = PpdbUser::whereNotNull('nomor_ujian')->orderBy('nomor_ujian', 'desc')->first();
            $nomorUjian = $lastUser ? str_pad($lastUser->nomorUjian + 1, 4, '0', STR_PAD_LEFT) : '0001';
            $jalur_pendaftaran = $data->jalur_pendaftaran;
            if($jalur_pendaftaran == 'prestasi'){
                $jalur_pendaftaran = 'PRES';
            }else if($jalur_pendaftaran == 'kepemimpinan'){
                $jalur_pendaftaran = 'KEPEM';
            }

            if ($data->status == 'tidak_valid') {
                $data->update([
                    'status' => 'Tidak Valid',
                    'note_validasi' => $request->note_validasi
                ]);
                return redirect()->route('admin.ppdb.index')->with('success', 'Data berhasil disimpan');
            }else{
                $data->update([
                    'status' => 'Valid',
                    'nomor_ujian' => $jalur_pendaftaran .' - ' . $nomorUjian,
                    'note_validasi' => $request->note_validasi
                ]);
                $pdf = Pdf::loadView('dashboard.ppdb.kartuujian', compact('data'))
                    ->setPaper('A4', 'landscape'); // 10cm x 14cm
                    return $pdf->download('kartuujian-' . $data->nama_lengkap . '.pdf');
            }

            // Tambahkan logika validasi di sini

            // Kirim email ke user
            // \Mail::to($userMail->email)->send(new \App\Mail\PPDBAcceptanceLetter($user));

            DB::commit();
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
