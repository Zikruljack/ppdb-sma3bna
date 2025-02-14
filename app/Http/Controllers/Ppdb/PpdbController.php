<?php

namespace App\Http\Controllers\Ppdb;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Str;
// use Illuminate\Hashing\BcryptHasher;


use App\Models\User;
use App\Models\PpdbUser;
use App\Models\NilaiRapor;
use App\Models\Mapel;
use App\Models\BerkasPpdb;


class PpdbController extends Controller{


    public function index(){
        return view('ppdb.index');
    }

    public function login(){
        return view('ppdb.auth.login');
    }

    public function loginAttempt(Request $request){
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            Log::warning('Validation failed', ['errors' => $validation->errors()]);
            return redirect()->back()->withErrors($validation)->withInput()->with('error', 'Tidak bisa disimpan!');
        }

        try {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect, please try again'],
            ]);
            }

            auth()->login($user);
            Log::info('User logged in successfully', ['email' => $request->email]);

            DB::commit();
            return redirect()->intended(route('ppdb.pendaftaran'))->with('success', 'Login successful');

        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaction
            Log::error('Login Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return redirect()->back()->withInput()->with(['error' => 'Terjadi error pada server.']);
        }
    }

    public function register(){
        return view('ppdb.auth.register');
    }

    public function registerAttempt(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'jalur_pendaftaran' => 'required|in:Prestasi,Kepemimpinan',
        ]);

        $user = Ppdb::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'jalur_pendaftaran' => $request->jalur_pendaftaran
        ]);

        auth()->login($user);

        return redirect()->route('home')->with('success', 'Registration successful.');
    }

    public function pendaftaran()
    {
        $user_id = auth()->id();
        $ppdbUser = PpdbUser::where('user_id', $user_id)->first() ?? new PpdbUser();

        $berkas = BerkasPpdb::where('user_id', $user_id)->first() ?? new BerkasPpdb();
        $wilayahProvinsi = DB::table('indonesia_provinces')->get();

        return view('ppdb.dashboard.steps.data_diri', compact(
            'ppdbUser',
            'wilayahProvinsi'
        ));
    }

    public function formulirDataDiri(Request $request)
{
    $userId = auth()->id();

    $validatedData = Validator::make($request->all(), [
        'nama_lengkap' => 'required|string|max:255',
        'nisn' => ['required', 'numeric', Rule::unique('ppdb_user')->ignore($userId, 'user_id')],
        'nik' => ['required', 'numeric', Rule::unique('ppdb_user')->ignore($userId, 'user_id')],
        'no_kk' => ['required', 'numeric', Rule::unique('ppdb_user')->ignore($userId, 'user_id')],
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tanggal_kk_dikeluarkan' => 'required|date',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|string|max:255',
        'agama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'gol_darah' => 'required|string|max:255',
        'tinggi_badan' => 'required|numeric',
        'berat_badan' => 'required|numeric',
        'kecamatan' => 'required|string|max:255',
        'kabupaten_kota' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'kode_pos' => 'required|numeric',
        'jalur_pendaftaran' => 'required|string|max:255',
        'no_hp' => 'required|numeric',
        'asal_sekolah' => 'required|string|max:255',
        'npsn_asal_sekolah' => 'required|numeric',
        'kabkota_asal_sekolah' => 'required|string|max:255',
        'nama_ayah' => 'required|string|max:255',
        'nama_ibu' => 'required|string|max:255',
        'pekerjaan_ayah' => 'required|string|max:255',
        'pekerjaan_ibu' => 'required|string|max:255',
        'jabatan_ayah' => 'required|string|max:255',
        'jabatan_ibu' => 'required|string|max:255',
        'alamat_ortu' => 'required|string|max:255',
        'no_hp_ayah' => 'required|numeric',
        'no_hp_ibu' => 'required|numeric',
    ]);

    if ($validatedData->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Tidak bisa disimpan!');
    }

    $validatedData = $validatedData->validated();

    if ($request->hasFile('foto')) {
        $validatedData['foto'] = $request->file('foto')->store('images', 'public');
    }

    try {
        DB::beginTransaction();
        PpdbUser::updateOrCreate(['user_id' => $userId], $validatedData);
        DB::commit();
        session()->push('completed_steps', 'ppdb.formulir.data_diri');
        return redirect()->route('ppdb.formulir.rapor')->with('success', 'Data Diri berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Tidak bisa disimpan!'. $e->getMessage());
    }
}

    public function formulirRaporView(){
        $user = auth()->user();
        // $ppdbUser = PpdbUser::where('user_id', $user->id)->first();
        $mapel = Mapel::select('id', 'mapel')->get();
        $nilaiRapors = NilaiRapor::where('user_id', $user->id)
                ->get()
                ->groupBy(['semester', 'mapel_id'])
                ->map(function ($semesterGroup) {
                    return $semesterGroup->mapWithKeys(function ($mapelGroup, $mapelId) {
                        return [$mapelId => $mapelGroup->first()->nilai]; // Ambil nilai langsung
                    });
                })
                ->toArray();
        // dd($nilaiRapors);
        return view('ppdb.dashboard.steps.rapor', compact('mapel', 'nilaiRapors'));
    }

    public function formulirRapor(Request $request)
{
    $userId = auth()->id();

    $validatedData = Validator::make($request->all(), [
        'nilai' => 'required|array',
        'nilai.*' => 'required|array',
        'nilai.*.*' => 'required|integer|min:86|max:100',
        'scan_rapor' => 'nullable|array',
        'scan_rapor.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
    ]);

    if ($validatedData->fails()) {
        return redirect()->back()->withErrors($validatedData)->withInput()->with('error', 'Tidak bisa disimpan!');
    }

    try {
        $nilaiRapors = $request->input('nilai');

        foreach ($nilaiRapors as $semester => $mapels) {
            foreach ($mapels as $mapel_id => $nilai) { // Gunakan mapel_id
                NilaiRapor::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'semester' => $semester,
                        'mapel_id' => $mapel_id, // ✅ Pastikan pakai mapel_id
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );
            }
        }

        return redirect()->route('ppdb.formulir.berkas')->with('success', 'Data Diri berhasil disimpan!');
    } catch (\Exception $e) {
        Log::error("Error: " . $e->getMessage());
        return redirect()->back()->withErrors($validatedData)->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}

    public function formulirBerkasView(){
        return view('ppdb.dashboard.steps.berkas');
    }

    public function formulirBerkas(Request $request)
{
    $userId = auth()->id();

    // dd($request->all());

    // Validasi input
    $validator = Validator::make($request->all(), [
        'kk' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'tanggal_kk_dikeluarkan' => 'required|date',
        'ktp_kia' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'surat_keterangan_aktif' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'akta' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    ]);

    if ($validator->fails()) {
        Log::warning('Validation failed', ['errors' => $validator->errors()]);
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Tidak bisa disimpan!');
    }

    // Ambil data hasil validasi
    $validatedData = $validator->validated();

    try {
        // Upload file KK
        $kkPath = $request->hasFile('kk')
            ? $request->file('kk')->store('berkas/kk', 'public')
            : null;

        // Upload file Akta Kelahiran
        $aktaPath = $request->hasFile('akta')
            ? $request->file('akta')->store('berkas/akta', 'public')
            : null;

        // Upload file KTP/KIA (Opsional)
        $ktpKiaPath = $request->hasFile('ktp_kia')
            ? $request->file('ktp_kia')->store('berkas/ktp_kia', 'public')
            : null;

        // Upload file Surat Keterangan Aktif (Opsional)
        $suratAktifPath = $request->hasFile('surat_keterangan_aktif')
            ? $request->file('surat_keterangan_aktif')->store('berkas/surat_keterangan_aktif', 'public')
            : null;

        // Simpan atau update data di database
        $berkas = BerkasPpdb::updateOrCreate(
            ['user_id' => $userId],
            [
                'kk_file' => $kkPath,
                'tanggal_kk_dikeluarkan' => $validatedData['tanggal_kk_dikeluarkan'],
                'ktp_kia_file' => $ktpKiaPath,
                'surat_keterangan_aktif' => $suratAktifPath,
                'akta_kelahiran_file' => $aktaPath,
            ]
        );

        // Simpan sertifikat jika ada
        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $sertifikat) {
                $path = $sertifikat->store('berkas/sertifikat', 'public');
                $berkas->sertifikat()->create(['file_path' => $path]);
            }
        }

        return redirect()->route('ppdb.resume')->with('success', 'Berkas berhasil disimpan!');
    } catch (\Exception $e) {
        Log::error("Error menyimpan berkas PPDB: " . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan, coba lagi.');
    }
}


    public function resume(){
        $user = auth()->user();
        $ppdbUser = PpdbUser::where('user_id', $user->id)->first();
        $mapel = Mapel::select('id', 'mapel')->get();
        $nilaiRapors = NilaiRapor::where('user_id', $user->id)
                ->get()
                ->groupBy(['semester', 'mapel_id']);
        $berkas = BerkasPpdb::where('user_id', $user->id)->first();
        return view('ppdb.dashboard.steps.detail', compact('ppdbUser', 'mapel', 'nilaiRapors', 'berkas'));
    }

}
