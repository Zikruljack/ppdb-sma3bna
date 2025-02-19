<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\PpdbUser;
use App\Models\Mapel;
use App\Models\BerkasPpdb;
use App\Models\Sertifikat;
use App\Models\NilaiRapor;
use App\Models\User;
use App\Models\PenilaianPeserta;

use App\DataTables\PesertaPPDBDataTable;
use App\DataTables\PesertaLulusDataTable;
use App\DataTables\ListPpdbUserDataTable;

use App\Mail\PPDBSelectionResult;

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
        $ppdbUser = PpdbUser::where('id', $id)->first();
        // dd($ppdbUser);
            if($ppdbUser == null){
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }
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

        $nilaiRataRata = $this->nilaiRataRataPerSemester($nilaiRapor);

        $penilaian = PenilaianPeserta::where('user_id', $ppdbUser->user_id)->first();

        return view('dashboard.ppdb.detail', compact('ppdbUser', 'nilaiRapor', 'provinsi', 'kabkota', 'kecamatan', 'sertifikat', 'berkasPendukung', 'nilaiRataRata', 'penilaian'));
    }

    //validasi ppdb
    public function validasiView($id){
        $ppdbUser = PpdbUser::whereNotIn('status', ['Tidak Valid', 'Pendaftar'])->where('id', $id)->first();

        // dd($ppdbUser);

        // check data ada apa tidak
        if($ppdbUser == null){
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        // dd($ppdbUser);
        $provinsi = DB::table('indonesia_provinces')->select('name')->where('code', $ppdbUser->provinsi)->first();
        $kabkota = DB::table('indonesia_cities')->select('name')->where('code', $ppdbUser->kabupaten_kota)->first();
        $kecamatan = DB::table('indonesia_districts')->select('name')->where('code', $ppdbUser->kecamatan)->first();

        $berkasPendukung = BerkasPpdb::where('user_id', $ppdbUser->user_id)->first();
        $sertifikat = Sertifikat::where('berkas_id', $berkasPendukung->id)->get();
        // dd($sertifikat);
        $nilaiRapor = NilaiRapor::where('user_id', $ppdbUser->user_id)
                ->with('mapel')
                ->orderBy('semester')
                ->get()
                ->groupBy('semester');

        $nilaiRataRata = $this->nilaiRataRataPerSemester($nilaiRapor);

        $penilaian = PenilaianPeserta::where('user_id', $ppdbUser->user_id)->first();
        return view('dashboard.ppdb.validasi', compact('ppdbUser', 'provinsi', 'kabkota', 'kecamatan', 'berkasPendukung', 'sertifikat', 'nilaiRapor', 'nilaiRataRata', 'penilaian'));

    }

    public function validasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:valid,tidak_valid,perbaikan',
            'note_validasi' => 'nullable|string',
            'nilai_rapor' => 'nullable|string',
            'nilai_sertifikat' => 'nullable|string',
        ],[
            'status.required' => 'Status validasi harus dipilih.',
            'note_validasi' => 'Note validasi harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        // dd($request->all());

        $verifikator = auth()->user()->name;

        $ppdbUser = PpdbUser::where('id', $id)->first();
        //this is for user ppdb to sending email only
        $user = User::where('id', $ppdbUser->user_id)->first();

        $penilaian = PenilaianPeserta::where('user_id', $ppdbUser->user_id)->first();

        $totalNilai = $request->nilai_rapor + $request->nilai_sertifikat;

        try {
            DB::beginTransaction();

            $lastUser = PpdbUser::whereNotNull('nomor_ujian')->orderBy('nomor_ujian', 'desc')->first();
            $nomorUjian = $lastUser ? str_pad($lastUser->nomorUjian + 1, 4, '0', STR_PAD_LEFT) : '0151';
            $jalur_pendaftaran = $ppdbUser->jalur_pendaftaran;

            if($jalur_pendaftaran == 'prestasi'){
                $jalur_pendaftaran = 'PRES';
            }else if($jalur_pendaftaran == 'kepemimpinan'){
                $jalur_pendaftaran = 'KEPEM';
            }

            if ($request->status == 'tidak_valid') {
                $ppdbUser->update([
                    'status' => 'Tidak Valid',
                    'note_validasi' => $request->note_validasi
                ]);
                PenilaianPeserta::create([
                    'user_id' => $ppdbUser->user_id,
                    'bobot_nilai_rapor' => $request->nilai_rapor,
                    'bobot_nilai_sertifikat' => $request->nilai_sertifikat,
                    'verifikator' => $verifikator
                ]);
            }else if($request->status == 'perbaikan'){
                //userppdb harus memperbaiki data diri
                $ppdbUser->update([
                    'status' => 'Perbaikan',
                    'note_validasi' => $request->note_validasi
                ]);
                PenilaianPeserta::create([
                    'user_id' => $user->id,
                    'bobot_nilai_rapor' => $request->nilai_rapor,
                    'bobot_nilai_sertifikat' => $request->nilai_sertifikat,
                    'verifikator' => $verifikator
                ]);

            }else if($request->status == 'valid'){
                $ppdbUser->update([
                    'status' => 'Valid',
                    'nomor_ujian' => $jalur_pendaftaran .' - ' . $nomorUjian,
                    'note_validasi' => $request->note_validasi
                ]);
                PenilaianPeserta::create([
                    'user_id' => $ppdbUser->user_id,
                    'bobot_nilai_rapor' => $request->nilai_rapor,
                    'bobot_nilai_sertifikat' => $request->nilai_sertifikat,
                    'verifikator' => $verifikator
                ]);
            }

            // Tambahkan logika validasi di sini
            // Kirim email ke user
            Mail::to($user->email)->send(new PPDBSelectionResult($user, $ppdbUser));

            DB::commit();

            return redirect()->route('admin.ppdb.index')->with('success', 'Data berhasil disimpan');

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

        return view('dashboard.ppdb.detailuser', compact('ppdbUser', 'provinsi', 'kabkota', 'kecamatan', 'nilaiRapor', 'sertifikat', 'berkasPendukung'));
    }


    public function edit($id){
        $ppdbUser = PpdbUser::where('id', $id)->first();
        $mapel = Mapel::select('id', 'mapel')->get();
        $nilaiRapors = NilaiRapor::where('user_id', $ppdbUser->user_id)
                ->get()
                ->groupBy(['semester', 'mapel_id'])
                ->map(function ($semesterGroup) {
                    return $semesterGroup->mapWithKeys(function ($mapelGroup, $mapelId) {
                        return [$mapelId => $mapelGroup->first()->nilai]; // Ambil nilai langsung
                    });
                })
                ->toArray();
                // dd($nilaiRapors);
        return view('dashboard.ppdb.edit', compact('ppdbUser', 'mapel', 'nilaiRapors'));
    }

    public function updateUserPpdb(Request $request, $id)
    {
        $ppdbUser = PpdbUser::where('id', $id)->firstOrFail();
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


    private function nilaiRataRataPerSemester($nilaiRapor){
        $rataRataPerSemester = [];

        foreach ($nilaiRapor as $semester => $nilaiMapel) {
            // Ambil semua nilai untuk semester tertentu
            $totalNilai = 0;
            $jumlahMapel = count($nilaiMapel);

            foreach ($nilaiMapel as $nilai) {
                $totalNilai += $nilai->nilai; // Penjumlahan nilai untuk semester ini
            }

            // Hitung rata-rata untuk semester ini
            $rataRataPerSemester[$semester] = $jumlahMapel > 0 ? $totalNilai / $jumlahMapel : 0;
        }

        return $rataRataPerSemester;
    }

    public function updateSertifikat(Request $request, $id, $id_sertifikat) {
        $ppdbUser = PpdbUser::where('id', $id)->firstOrFail();
        $berkasPendukung = BerkasPpdb::where('user_id', $ppdbUser->user_id)->first();
        $sertifikat = Sertifikat::where('id', $id_sertifikat)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'tingkat_kejuaraan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            Log::error($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Simpan perubahan sertifikat
            $sertifikat->update([
                'tingkat_kejuaraan' => $request->tingkat_kejuaraan
            ]);

            DB::commit();
            return response()->json('Data telah tersimpan');
            return redirect()->route('admin.ppdb.index')->with('success', 'Data telah tersimpan');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error("message:" . $e->getMessage());
            return redirect()->route('admin.ppdb.index')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }


    public function inputNilaiLainView()
    {
        return view('dashboard.ppdb.ujian.nilai');
    }

    public function cariPeserta(Request $request)
    {
        // Pastikan ada nomor yang dicari
        if (!$request->has('nomor')) {
            return response()->json(['error' => 'Nomor tidak boleh kosong'], 400);
        }

        try {
            // Cari berdasarkan nomor peserta atau nomor ujian
            $ppdbUser = PpdbUser::where('nomor_peserta', $request->nomor)
                                ->orWhere('nomor_ujian', $request->nomor)
                                ->firstOrFail();

            return response()->json($ppdbUser);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Peserta tidak ditemukan'], 404);
        }
    }


    public function inputNilaiWawancara(Request $request, $id){

        $verifikator = auth()->user()->name;
        // dd($request->all());

        $request->validate([
            'bobot_wawancara' => 'required|numeric|min:0|max:100',
            'verifikator' => 'required|string|max:255',
        ]);

        $penilaian = PenilaianPeserta::updateOrCreate(
            ['user_id' => $id],
            [
                'bobot_nilai_wawancara' => $request->bobot_wawancara * 0.1,
                'verifikator' => $verifikator,
            ]
        );

        return response()->json([
            'message' => 'Nilai wawancara berhasil disimpan',
            'data' => $penilaian
        ]);

    }

    public function inputNilaiQuran(Request $request, $id){
        $verifikator = auth()->user()->name;
        // dd($request->all());

        $request->validate([
            'bobot_baca_quran' => 'required|numeric|min:0|max:100',
            'verifikator' => 'required|string|max:255',
        ]);

        $penilaian = PenilaianPeserta::updateOrCreate(
            ['user_id' => $id],
            [
                'bobot_nilai_baca_quran' => $request->bobot_baca_quran * 0.1,
                'verifikator' => $verifikator,
            ]
        );

        return response()->json([
            'message' => 'Nilai wawancara berhasil disimpan',
            'data' => $penilaian
        ]);

    }


}
