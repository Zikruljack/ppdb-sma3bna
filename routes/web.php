<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/get-kabupaten', function (Request $request) {
    $kabupaten = DB::table('indonesia_cities')
        ->where('province_code', $request->province_id)
        ->get();
    return response()->json($kabupaten);
});

Route::get('/get-kecamatan', function (Request $request) {
    $kecamatan = DB::table('indonesia_districts')
        ->where('city_code', $request->city_id)
        ->get();
    return response()->json($kecamatan);
});
//Landing Page
Route::prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing.page');
    Route::get('/ppdb', [App\Http\Controllers\Ppdb\PpdbController::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/login', [App\Http\Controllers\Ppdb\PpdbController::class , 'login'])->name('login.ppdb');
    Route::post('/ppdb/login/attempt', [App\Http\Controllers\Ppdb\PpdbController::class , 'loginAttempt'])->name('login.attempt');
    Route::get('/ppdb/register', [App\Http\Controllers\Ppdb\PpdbController::class , 'register'])->name('register.ppdb');
    Route::post('/ppdb/register/attempt' , [App\Http\Controllers\Ppdb\PpdbController::class , 'registerAttempt'])->name('register.attempt');
    // Route::get('/profil', [App\Http\Controllers\LandingPageController::class, 'profil'])->name('profil');
    // Route::get('/berita', [App\Http\Controllers\LandingPageController::class, 'berita'])->name('berita');
    // Route::get('/berita/{slug}', [App\Http\Controllers\LandingPageController::class, 'beritaDetail'])->name('berita.detail');
    // Route::get('/galeri', [App\Http\Controllers\LandingPageController::class, 'galeri'])->name('galeri');
    // Route::get('/galeri/{slug}', [App\Http\Controllers\LandingPageController::class, 'galeriDetail'])->name('galeri.detail');
    // Route::get('/pengumuman', [App\Http\Controllers\LandingPageController::class, 'pengumuman'])->name('pengumuman');
    // // Route::get('/pengumuman/{slug}', [App\Http\Controllers\LandingPageController::class, 'pengumumanDetail'])->name('pengumuman.detail');
    // Route::get('/kontak', [App\Http\Controllers\LandingPageController::class, 'kontak'])->name('kontak');
    // Route::get('/tentang', [App\Http\Controllers\LandingPageController::class, 'tentang'])->name('tentang');
    // Route::get('/prestasi', [App\Http\Controllers\LandingPageController::class, 'prestasi'])->name('prestasi');
    // Route::get('/struktur-organisasi', [App\Http\Controllers\LandingPageController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
});


Auth::routes([
    'register' => false,
    'verify' => true
]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route untuk memproses verifikasi email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/ppdb/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route untuk mengirim ulang email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Email verifikasi telah dikirim ulang.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



//admin
Route::middleware(['auth', 'role:developer|admin|verifikator'])->group(function () {

    Route::prefix('admin')->group(function () {

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::prefix('ppdb')->group(function () {
            Route::get('/peserta', [App\Http\Controllers\Admin\Ppdb\AdminPpdbController::class, 'index'])->name('admin.ppdb.index');
            Route::post('/peserta/validasi/{id}', [App\Http\Controllers\Admin\Ppdb\AdminPpdbController::class, 'validasi'])->name('admin.ppdb.validasi');
            Route::get('/peserta/detail/{id}', [App\Http\Controllers\Admin\Ppdb\AdminPpdbController::class, 'detailPeserta'])->name('admin.ppdb.detail.peserta');
            Route::post('/peserta/validasi/{id}', [App\Http\Controllers\Admin\Ppdb\AdminPpdbController::class, 'validasi'])->name('admin.ppdb.validasi');
            Route::get('/peserta/download/kartu/{id}', [App\Http\Controllers\Admin\Ppdb\AdminPpdbController::class, 'downloadKartu'])->name('admin.ppdb.download.kartu');

            //setting ppdb
            Route::get('/setting', [App\Http\Controllers\Admin\Ppdb\AdminPpdbSettingController::class, 'index'])->name('admin.ppdb.setting');
            Route::post('/setting/save', [App\Http\Controllers\Admin\Ppdb\AdminPpdbSettingController::class, 'save'])->name('admin.ppdb.setting.save');
        });

        //users
        Route::get('/users', [App\Http\Controllers\Admin\User\UserController::class, 'index'])->name('admin.users.index');

        //cms
        Route::prefix('cms')->group(function () {

            //berita
            Route::prefix('berita')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Cms\BeritaController::class, 'index'])->name('admin.cms.berita.index');
            });

            //galeri
            Route::prefix('galeri')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Cms\GaleriController::class, 'index'])->name('admin.cms.galeri.index');
            });

            //pengumuman
            Route::prefix('pengumuman')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Cms\PengumumanController::class, 'index'])->name('admin.cms.pengumuman.index');
            });
        });

    });
});

//ppdb

Route::prefix('ppdb')->middleware(['auth','verified', 'role:developer|siswa'])->group(function () {
    Route::get('/pendaftaran', [App\Http\Controllers\Ppdb\PpdbController::class, 'pendaftaran'])->name('ppdb.pendaftaran');
    Route::post('/formulir/datadiri', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirDataDiri'])->name('ppdb.formulir.data_diri');
    Route::get('/formulir/rapor', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirRaporView'])->name('ppdb.formulir.rapor');
    Route::post('/formulir/rapor/upload', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirRapor'])->name('ppdb.formulir.rapor.upload');
    Route::get('/formulir/berkas', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirBerkasView'])->name('ppdb.formulir.berkas');
    Route::post('/formulir/berkas/upload', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirBerkas'])->name('ppdb.formulir.berkas.upload');
    Route::post('/formulir/finalisasi', [App\Http\Controllers\Ppdb\PpdbController::class, 'finalisasi'])->name('ppdb.formulir.finalisasi');
    Route::get('/resume', [App\Http\Controllers\Ppdb\PpdbController::class, 'resume'])->name('ppdb.resume');
    Route::get('/download/{id}', [App\Http\Controllers\Ppdb\PpdbController::class, 'downloadForm'])->name('ppdb.download');
    Route::get('/pengumuman', [App\Http\Controllers\Ppdb\PpdbController::class, 'pengumuman'])->name('ppdb.pengumuman');
});
