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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Str;
// use Illuminate\Hashing\BcryptHasher;

use Barryvdh\DomPDF\Facade\Pdf;


use App\Models\User;
use App\Models\PpdbUser;
use App\Models\NilaiRapor;
use App\Models\Mapel;
use App\Models\BerkasPpdb;
use App\Models\Sertifikat;


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
            // Log::info('User logged in successfully', ['email' => $request->email]);

            DB::commit();
            return redirect()->route('ppdb.dashboard')->with('success', 'Login successful');

        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaction
            // Log::error('Login Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return redirect()->back()->withInput()->with(['error' => 'Terjadi error pada server.']);
        }
    }

    public function register(){
        return view('ppdb.auth.register');
    }

    public function registerAttempt(Request $request){


        $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'jalur_pendaftaran' => 'required|in:prestasi,kepemimpinan',
            ],[
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.unique' => 'Email sudah digunakan.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password harus memiliki minimal 8 karakter.',
                'password.confirmed' => 'Password tidak cocok.',
                'jalur_pendaftaran.required' => 'Jalur pendaftaran harus dipilih.',
            ]
        );

        if ($validation->fails()) {
            // Log::warning('Validation failed', ['errors' => $validation->errors()]);
            return redirect()->back()->withErrors($validation)->withInput()->with('error', 'Tidak bisa disimpan!', $validation->errors());
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $userPpdb = PpdbUser::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->name,
                'jalur_pendaftaran' => $request->jalur_pendaftaran,
            ]);

            $user->assignRole('siswa');

            //send email verification
            $user->sendEmailVerificationNotification();

            DB::commit();

            return redirect()->route('login.ppdb')->with('success', 'Registrasi berhasil, mohon cek email untuk verifikasi email anda.');
        } catch (\Exception $e) {
            DB::rollback();
            // Log::error(['error' => $e->getMessage(), 'trace' => $e->getTrace()]);
            return redirect()->back()->withInput()->with('error', 'Terjadi error pada server: ' . $e->getMessage());
        }
    }

    public function dashboard() {
        $user = auth()->user();
        $ppdbUser = PpdbUser::where('user_id', $user->id)->first();
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

        $berkas = BerkasPpdb::where('user_id', $user->id)->first();
        $dataDiriLengkap = $ppdbUser ? true : false;
        $nilaiRaporLengkap = !empty($nilaiRapors);
        $berkasLengkap = !is_null($berkas);
        $sudahValidasi = $ppdbUser->status === 'Valid'; // Sesuaikan dengan field di database

        return view('ppdb.dashboard.dashboard', compact(
            'dataDiriLengkap', 'nilaiRaporLengkap', 'berkasLengkap', 'sudahValidasi', 'ppdbUser'
        ));
    }


    public function pendaftaran()
    {
        $user_id = auth()->id();
        $ppdbUser = PpdbUser::where('user_id', $user_id)->first();
        $wilayahProvinsi = DB::table('indonesia_provinces')->get();

        return view('ppdb.dashboard.steps.data_diri', compact(
            'ppdbUser',
            'wilayahProvinsi'
        ));
    }

    public function formulirDataDiri(Request $request)
{
    $userId = auth()->id();

    $validator = Validator::make($request->all(), [
        'nama_lengkap' => 'required|string|max:255',
        'nisn' => ['required', 'min:10', 'numeric', Rule::unique('ppdb_user')->ignore($userId, 'user_id')],
        'nik' => ['required', 'min:16' ,'numeric', Rule::unique('ppdb_user')->ignore($userId, 'user_id')],
        'no_kk' => ['required', 'numeric'],
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
    ],[
        'nisn.required' => 'NISN harus diisi.',
        'nisn.numeric' => 'NISN harus berupa angka.',
        'nisn.unique' => 'NISN sudah digunakan.',
        'nisn.min' => 'NISN harus 10 digit angka',
        'nik.required' => 'NIK harus diisi.',
        'nik.numeric' => 'NIK harus berupa angka.',
        'nik.unique' => 'NIK sudah digunakan.',
        'nik.min' => 'NIK harus 16 digit angka',
        'no_kk.required' => 'Nomor KK harus diisi.',
        'no_kk.numeric' => 'Nomor KK harus berupa angka.',
        'foto.image' => 'Foto harus berupa gambar.',
        'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau svg.',
        'foto.max' => 'Foto tidak boleh lebih dari 2048 kilobytes.',
        'tanggal_kk_dikeluarkan.required' => 'Tanggal KK dikeluarkan harus diisi.',
        'tanggal_kk_dikeluarkan.date' => 'Tanggal KK dikeluarkan harus berupa tanggal yang valid.',
        'tempat_lahir.required' => 'Tempat lahir harus diisi.',
        'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
        'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
        'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
        'agama.required' => 'Agama harus diisi.',
        'alamat.required' => 'Alamat harus diisi.',
        'gol_darah.required' => 'Golongan darah harus diisi.',
        'tinggi_badan.required' => 'Tinggi badan harus diisi.',
        'tinggi_badan.numeric' => 'Tinggi badan harus berupa angka.',
        'berat_badan.required' => 'Berat badan harus diisi.',
        'berat_badan.numeric' => 'Berat badan harus berupa angka.',
        'kecamatan.required' => 'Kecamatan harus diisi.',
        'kabupaten_kota.required' => 'Kabupaten/Kota harus diisi.',
        'provinsi.required' => 'Provinsi harus diisi.',
        'kode_pos.required' => 'Kode pos harus diisi.',
        'kode_pos.numeric' => 'Kode pos harus berupa angka.',
        'jalur_pendaftaran.required' => 'Jalur pendaftaran harus diisi.',
        'no_hp.required' => 'Nomor HP harus diisi.',
        'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        'asal_sekolah.required' => 'Asal sekolah harus diisi.',
        'npsn_asal_sekolah.required' => 'NPSN asal sekolah harus diisi.',
        'npsn_asal_sekolah.numeric' => 'NPSN asal sekolah harus berupa angka.',
        'kabkota_asal_sekolah.required' => 'Kabupaten/Kota asal sekolah harus diisi.',
        'nama_ayah.required' => 'Nama ayah harus diisi.',
        'nama_ibu.required' => 'Nama ibu harus diisi.',
        'pekerjaan_ayah.required' => 'Pekerjaan ayah harus diisi.',
        'pekerjaan_ibu.required' => 'Pekerjaan ibu harus diisi.',
        'jabatan_ayah.required' => 'Jabatan ayah harus diisi.',
        'jabatan_ibu.required' => 'Jabatan ibu harus diisi.',
        'alamat_ortu.required' => 'Alamat orang tua harus diisi.',
        'no_hp_ayah.required' => 'Nomor HP ayah harus diisi.',
        'no_hp_ayah.numeric' => 'Nomor HP ayah harus berupa angka.',
        'no_hp_ibu.required' => 'Nomor HP ibu harus diisi.',
        'no_hp_ibu.numeric' => 'Nomor HP ibu harus berupa angka.',
    ]);

    if ($validator->fails()) {
        Log::warning(["validasi eror", $validator->errors()]);
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Tidak bisa disimpan!', $validator->errors());
    }

    $params = $validator->validate();

    if ($request->hasFile('foto')) {
        $params['foto'] = $request->file('foto')->store('images', 'public');
    }
    $params['status'] = 'Pendaftar';

    try {
        DB::beginTransaction();

        PpdbUser::updateOrCreate(['user_id' => $userId], $params);
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
        $ppdbUser = PpdbUser::where('user_id', $user->id)->first();
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
        return view('ppdb.dashboard.steps.rapor', compact('mapel', 'nilaiRapors', 'ppdbUser'));
    }

    public function formulirRapor(Request $request)
{
    $userId = auth()->id();

    $userPpdb = PpdbUser::where('user_id', $userId)->first();

    if($userPpdb->jalur_pendaftaran == 'prestasi'){
        $minNilai = 86;
    }else{
        $minNilai = 82;
    }
        $validatedData = Validator::make($request->all(), [
                'nilai' => 'required|array',
                'nilai.*' => 'required|array',
                'nilai.*.*' => "required|integer|min:$minNilai|max:100",
                'scan_rapor' => 'nullable|array',
                'scan_rapor.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
            ],[
                'nilai.*.*' => "Nilai harus antara $minNilai dan 100",
                'scan_rapor.*' => 'Scan Rapor harus berformat PDF, JPG, JPEG, atau PNG',
            ]
        );
    if ($validatedData->fails()) {
        return redirect()->back()->withErrors($validatedData)->withInput()->with('error', 'Tidak bisa disimpan!');
    }

    try {
        DB::beginTransaction();
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
                        'scan_rapor' => $request->hasFile("scan_rapor.$semester") ? $request->file("scan_rapor.$semester")->store('rapor', 'public') : null
                    ]
                );
            }
        }

        DB::commit();
        return redirect()->route('ppdb.formulir.berkas')->with('success', 'Data Diri berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollback();
        Log::error("Error: " . $e->getMessage());
        return redirect()->back()->withErrors($validatedData)->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}

    public function formulirBerkasView(){
        $ppdbUser = PpdbUser::where('user_id', auth()->id())->first();
        // $nilaiRapor = NilaiRapor::where('user_id', auth()->id())->first();

        return view('ppdb.dashboard.steps.berkas', compact('ppdbUser'));
    }

    public function formulirBerkas(Request $request)
{
    $userId = auth()->id();

    // dd($request->all());

    // Validasi input
    $validator = Validator::make($request->all(), [
        'kk' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'ktp_kia' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'surat_keterangan_aktif' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'akta' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'nama_sertifikat.*' => 'nullable|string|max:255',
        'penandatangan_sertifikat.*' => 'nullable|string|max:255',
        'jenis_sertifikat.*' => 'nullable|in:akademik,non akademik',
        'tanggal_dikeluarkan.*' => 'nullable|date',
        'juara.*' => 'nullable|string|max:255',
        'tingkat_kejuaraan.*' => 'nullable|string|max:255',
        'sk_ketua_osis' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'periode' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        Log::warning('Validation failed', ['errors' => $validator->errors()]);
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Tidak bisa disimpan!');
    }

    // Ambil data hasil validasi
    $validatedData = $validator->validated();

    try {
        DB::beginTransaction();
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

        $skKetuaOsisFile = $request->hasFile('sk_ketua_osis') ? $request->file('sk_ketua_osis')->store('berkas/ketuaOsis/', 'public') : null;
        // Simpan atau update data di database
        $berkas = BerkasPpdb::updateOrCreate(
            ['user_id' => $userId],
            [
                'kk_file' => $kkPath,
                'ktp_kia_file' => $ktpKiaPath,
                'surat_keterangan_aktif' => $suratAktifPath,
                'akta_kelahiran_file' => $aktaPath,
                'sk_ketua_osis' => $skKetuaOsisFile,
                'penandatangan_sk' => $request->penandatangan_sk ? $request->penandatangan_sk : null,
                'periode' => $request->periode ? $request->periode : null,
            ]
        );


        // Simpan data sertifikat
        foreach ($validatedData['sertifikat'] as $index => $sertifikat) {
            $sertifikatPath = $sertifikat ? $sertifikat->store('berkas/sertifikat', 'public') : null;
            Sertifikat::create([
                'berkas_id' => $berkas->id,
                'file_path' => $sertifikatPath,
                'nama_sertifikat' => $validatedData['nama_sertifikat'][$index],
                'penandatangan_sertifikat' => $validatedData['penandatangan_sertifikat'][$index],
                'jenis_sertifikat' => $validatedData['jenis_sertifikat'][$index],
                'tanggal_dikeluarkan' => $validatedData['tanggal_dikeluarkan'][$index],
                'juara' => $validatedData['juara'][$index],
                'tingkat_kejuaraan' => $validatedData['tingkat_kejuaraan'][$index],
            ]);
        }


        DB::commit();
        return redirect()->route('ppdb.resume')->with('success', 'Berkas berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollback();
        Log::error("Error menyimpan berkas PPDB: " . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan, coba lagi.');
    }
}


    public function resume()
    {
        $user = auth()->user();
        $ppdbUser = PpdbUser::where('user_id', $user->id)->first();
        $mapel = Mapel::select('id', 'mapel')->get();
        $nilaiRapor = NilaiRapor::where('user_id', $user->id)
                ->with('mapel')
                ->orderBy('semester')
                ->get()
                ->groupBy('semester');

        $berkasPendukung = BerkasPpdb::where('user_id', $user->id)->first();
        if($berkasPendukung != null){
            $sertifikat = Sertifikat::where('berkas_id', $berkasPendukung->id)->get();
        }

        $dataDiriLengkap = $ppdbUser ? true : false;
        $nilaiRaporLengkap = !empty($nilaiRapor);
        $berkasLengkap = !is_null($berkasPendukung);

        if (!$dataDiriLengkap || !$nilaiRaporLengkap || !$berkasLengkap) {
            return redirect()->route('ppdb.pendaftaran')->with('error', 'Lengkapi semua data terlebih dahulu.');
        }

        return view('ppdb.dashboard.steps.detail', compact('ppdbUser', 'mapel', 'nilaiRapor', 'berkasPendukung', 'sertifikat'));
    }

    public function finalisasi()
    {
        $user = auth()->user();
        $ppdbUser = PpdbUser::where('user_id', $user->id)->first();

        if (!$ppdbUser) {
            return redirect()->back()->with('error', 'Data belum lengkap!');
        }

        try {
            DB::beginTransaction();
            $lastUser = PpdbUser::whereNotNull('nomor_peserta')->orderBy('nomor_peserta', 'desc')->first();
            $nomorPeserta = $lastUser ? str_pad($lastUser->nomor_peserta + 1, 4, '0', STR_PAD_LEFT) : '0151';
            $ppdbUser->update(['status' => 'Final', 'nomor_peserta' => $nomorPeserta]);
            DB::commit();
            return redirect()->route('ppdb.resume')->with('success', 'Pendaftaran telah difinalisasi. Anda tidak bisa mengubah data lagi.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat finalisasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat finalisasi.');
        }
    }

    public function downloadForm($id){
        $ppdbUser = PpdbUser::where('id', $id)->first();
        $mapel = Mapel::select('id', 'mapel')->get();
        $nilaiRapor = NilaiRapor::where('user_id', $ppdbUser->user_id)
                ->with('mapel')
                ->orderBy('semester')
                ->get()
                ->groupBy('semester');

        $berkas = BerkasPpdb::where('user_id', $ppdbUser->user_id)->first();
        $pdf = Pdf::loadView('ppdb.dashboard.pdf', compact('ppdbUser', 'mapel', 'nilaiRapor', 'berkas'));

        return $pdf->download('formulir-pendaftaran.pdf');
    }


    public function profile(){
        $user = auth()->user();
        $ppdbUser = PpdbUser::where('user_id', $user->id)->first();
        return view('ppdb.dashboard.profile', compact('ppdbUser'));
    }

    public function profileAttempt(Request $request)
{
    $user = Auth::user();

    try {
        DB::beginTransaction();
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update email
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        DB::commit();
        return back()->with('success', 'Profil berhasil diperbarui!');
    } catch (\Exception $e) {
        // Log error
        Log::error('Error updating profile: ' . $e->getMessage(), [
            'user_id' => $user->id,
            'email' => $request->email,
        ]);

        DB::rollback();
        return back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
    }
}

}
