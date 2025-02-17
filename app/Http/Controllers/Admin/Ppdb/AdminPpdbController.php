<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\PpdbUser;
use App\Models\Mapel;
use App\Models\BerkasPpdb;
use App\Models\Sertifikat;
use App\Models\NilaiRapor;
use App\Models\User;

use App\DataTables\PesertaPPDBDataTable;
use App\DataTables\PesertaLulusDataTable;
use App\DataTables\ListPpdbUserDataTable;

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
            'status' => 'required|in:valid,tidak_valid,perbaikan',
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
            Log::info($request->all());
            if ($data->status == 'tidak_valid') {
                $data->update([
                    'status' => 'Tidak Valid',
                    'note_validasi' => $request->note_validasi
                ]);
                return redirect()->route('admin.ppdb.index')->with('success', 'Data berhasil disimpan');
            }elseif($data->status == 'perbaikan'){
                //userppdb harus memperbaiki data diri
                $data->update([
                    'status' => 'Perbaikan',
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

    public function fullListUserPpdb(ListPpdbUserDataTable $dataTables){
        return $dataTables->render('dashboard.ppdb.list');
    }

    public function detailListUserPpdb($id){
        $ppdbUser = PpdbUser::where('id', $id)->first();
        $provinsi = DB::table('indonesia_provinces')->select('name')->where('code', $ppdbUser->provinsi)->first();
        $kabkota = DB::table('indonesia_cities')->select('name')->where('code', $ppdbUser->kabupaten_kota)->first();
        $kecamatan = DB::table('indonesia_districts')->select('name')->where('code', $ppdbUser->kecamatan)->first();
        $nilaiRapor = NilaiRapor::where('user_id', $ppdbUser->user_id)
            ->with('mapel')
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');

        $berkasPendukung = BerkasPpdb::where('user_id', $ppdbUser->user_id)->first();
        $sertifikat = $berkasPendukung ? Sertifikat::where('berkas_id', $berkasPendukung->id)->get() : collect();

        $provinsi = $provinsi ? $provinsi->name : 'Data tidak ditemukan';
        $kabkota = $kabkota ? $kabkota->name : 'Data tidak ditemukan';
        $kecamatan = $kecamatan ? $kecamatan->name : 'Data tidak ditemukan';

        return view('dashboard.ppdb.detailuser', compact('ppdbUser', 'provinsi', 'kabkota', 'kecamatan', 'nilaiRapor', 'sertifikat', 'berkasPendukung'));
    }


    public function edit($id){
        $ppdbUser = PpdbUser::where('id', $id)->first();
        return view('dashboard.ppdb.edit', compact('ppdbUser'));
    }

    // public function updateUserPpdb(Request $request, $id){


    //     $ppdbUser = PpdbUser::where('id', $id)->first();

    //     $provinsi = DB::table('indonesia_provinces')->select('name')->where('code', $ppdbUser->provinsi)->first();
    //     $kabkota = DB::table('indonesia_cities')->select('name')->where('code', $ppdbUser->kabupaten_kota)->first();
    //     $kecamatan = DB::table('indonesia_districts')->select('name')->where('code', $ppdbUser->kecamatan)->first();

    //     $nilaiRapor = NilaiRapor::where('user_id', $ppdbUser->user_id)
    //         ->with('mapel')
    //         ->orderBy('semester')
    //         ->get()
    //         ->groupBy('semester');
    //     $berkasPendukung = BerkasPpdb::where('user_id', $ppdbUser->user_id)->first();
    //     $sertifikat = $berkasPendukung ? Sertifikat::where('berkas_id', $berkasPendukung->id)->get() : collect();


    //     $validator = Validator::make($request->all(), [
    //         // ppdb user
    //         'jalur_pendaftaran' => 'nullable|in:prestasi,kepemimpinan',
    //         'nomor_peserta' => 'nullable|numeric',
    //         'nama_lengkap' => 'nullable|string',
    //         'tempat_lahir' => 'nullable|string',
    //         'tanggal_lahir' => 'nullable|date',
    //         'jenis_kelamin' => 'nullable|in:Laki-Laki,Perempuan',
    //         'agama' => 'nullable',
    //         'alamat' => 'nullable|string',
    //         'provinsi' => 'nullable|exists:indonesia_provinces,code',
    //         'kabupaten_kota' => 'nullable|exists:indonesia_cities,code',
    //         'kecamatan' => 'nullable|exists:indonesia_districts,code',
    //         'no_hp' => 'nullable|string',
    //         'email' => 'nullable|email|unique:ppdb_users,email,' . $ppdbUser->id,
    //         'status' => 'nullable|in:Valid,Tidak Valid',
    //         'nomor_ujian' => 'nullable_if:status,Valid|string',
    //         'note_validasi' => 'nullable_if:status,Tidak Valid|string',
    //         // Berkas Pendukung
    //         'kk' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'ktp_kia' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'surat_keterangan_aktif' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'akta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'nama_sertifikat.*' => 'nullable|string|max:255',
    //         'penandatangan_sertifikat.*' => 'nullable|string|max:255',
    //         'jenis_sertifikat.*' => 'nullable|in:akademik,non akademik',
    //         'tanggal_dikeluarkan.*' => 'nullable|date',
    //         'juara.*' => 'nullable|string|max:255',
    //         'tingkat_kejuaraan.*' => 'nullable|string|max:255',
    //         'sk_ketua_osis' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'periode' => 'nullable|string|max:255',

    //         // nilai rapor
    //         'nilai' => 'required|array',
    //         'nilai.*' => 'required|array',
    //         'nilai.*.*' => "required|integer|min:80|max:100",
    //         'scan_rapor' => 'nullable|array',
    //         'scan_rapor.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $validatedData = $validator->validated();

    //     try{
    //         DB::beginTransaction();



    //         DB::commit();
    //         return redirect()->route('admin.ppdb.index')->with('success', 'Data telah tersimpan');
    //     }catch(Exception $e){
    //         DB::rollBack();
    //         \Log::error("message:" . $e->getMessage());
    //         return redirect()->route('admin.ppdb.index')->with('error', 'Terjadi kesalahan saat menyimpan data');
    //     }
    // }

    public function updateUserPpdb(Request $request, $id)
    {
        $ppdbUser = PpdbUser::where('id', $id)->firstOrFail();

        $provinsi = DB::table('indonesia_provinces')->select('name')->where('code', $ppdbUser->provinsi)->first();
        $kabkota = DB::table('indonesia_cities')->select('name')->where('code', $ppdbUser->kabupaten_kota)->first();
        $kecamatan = DB::table('indonesia_districts')->select('name')->where('code', $ppdbUser->kecamatan)->first();

        $nilaiRapor = NilaiRapor::where('user_id', $ppdbUser->user_id)
            ->with('mapel')
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');
        $berkasPendukung = BerkasPpdb::where('user_id', $ppdbUser->user_id)->first();
        $sertifikat = $berkasPendukung ? Sertifikat::where('berkas_id', $berkasPendukung->id)->get() : collect();

        $validator = Validator::make($request->all(), [
            'jalur_pendaftaran' => 'nullable|in:prestasi,kepemimpinan',
            'nomor_peserta' => 'nullable|numeric',
            'nama_lengkap' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-Laki,Perempuan',
            'agama' => 'nullable',
            'alamat' => 'nullable|string',
            'provinsi' => 'nullable|exists:indonesia_provinces,code',
            'kabupaten_kota' => 'nullable|exists:indonesia_cities,code',
            'kecamatan' => 'nullable|exists:indonesia_districts,code',
            'no_hp' => 'nullable|string',
            'email' => 'nullable|email|unique:ppdb_users,email,' . $ppdbUser->id,
            'status' => 'nullable|in:Valid,Tidak Valid',
            'nomor_ujian' => 'nullable_if:status,Valid|string',
            'note_validasi' => 'nullable_if:status,Tidak Valid|string',
            'nilai' => 'required|array',
            'nilai.*' => 'required|array',
            'nilai.*.*' => "required|integer|min:80|max:100",
            'scan_rapor' => 'nullable|array',
            'scan_rapor.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        try {
            DB::beginTransaction();

            // Simpan data PPDB user
            $ppdbUser->update($validatedData);

            // Simpan data nilai rapor
            foreach ($validatedData['nilai'] as $semester => $mapel) {
                foreach ($mapel as $mapel_id => $nilai) {
                    NilaiRapor::updateOrCreate(
                        [
                            'user_id' => $ppdbUser->user_id,
                            'semester' => $semester,
                            'mapel_id' => $mapel_id,
                        ],
                        ['nilai' => $nilai]
                    );
                }
            }

            DB::commit();
            return redirect()->route('admin.ppdb.index')->with('success', 'Data telah tersimpan');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error("message:" . $e->getMessage());
            return redirect()->route('admin.ppdb.index')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }


}
