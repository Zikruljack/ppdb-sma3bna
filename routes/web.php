<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    Route::get('/ppdb/register/attempt' , [App\Http\Controllers\Ppdb\PpdbController::class , 'registerAttempt'])->name('register.attempt');
    Route::get('/profil', [App\Http\Controllers\LandingPageController::class, 'profil'])->name('profil');
    Route::get('/berita', [App\Http\Controllers\LandingPageController::class, 'berita'])->name('berita');
    Route::get('/berita/{slug}', [App\Http\Controllers\LandingPageController::class, 'beritaDetail'])->name('berita.detail');
    Route::get('/galeri', [App\Http\Controllers\LandingPageController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{slug}', [App\Http\Controllers\LandingPageController::class, 'galeriDetail'])->name('galeri.detail');
    Route::get('/pengumuman', [App\Http\Controllers\LandingPageController::class, 'pengumuman'])->name('pengumuman');
    // Route::get('/pengumuman/{slug}', [App\Http\Controllers\LandingPageController::class, 'pengumumanDetail'])->name('pengumuman.detail');
    Route::get('/kontak', [App\Http\Controllers\LandingPageController::class, 'kontak'])->name('kontak');
    Route::get('/tentang', [App\Http\Controllers\LandingPageController::class, 'tentang'])->name('tentang');
    Route::get('/prestasi', [App\Http\Controllers\LandingPageController::class, 'prestasi'])->name('prestasi');
    Route::get('/struktur-organisasi', [App\Http\Controllers\LandingPageController::class, 'strukturOrganisasi'])->name('struktur-organisasi');


});

Route::prefix('secure')->group(function () {
    Auth::routes([
        'register' => false,
    ]);
});

Route::middleware(['auth', 'role:developer|admin'])->group(function () {

    Route::prefix('admin')->group(function () {

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

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

Route::prefix('wilayah')->middleware(['auth'])->group(function () {

});
//ppdb

Route::prefix('ppdb')->middleware(['auth', 'role:developer|siswa'])->group(function () {
    Route::get('/pendaftaran', [App\Http\Controllers\Ppdb\PpdbController::class, 'pendaftaran'])->name('ppdb.pendaftaran');
    Route::post('/formulir/datadiri', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirDataDiri'])->name('ppdb.formulir.data_diri');
    Route::get('/formulir/rapor', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirRaporView'])->name('ppdb.formulir.rapor');
    Route::post('/formulir/rapor/upload', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirRapor'])->name('ppdb.formulir.rapor.upload');
    Route::get('/formulir/berkas', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirBerkasView'])->name('ppdb.formulir.berkas');
    Route::post('/formulir/berkas/upload', [App\Http\Controllers\Ppdb\PpdbController::class, 'formulirBerkas'])->name('ppdb.formulir.berkas.upload');
    Route::get('/resume', [App\Http\Controllers\Ppdb\PpdbController::class, 'resume'])->name('ppdb.resume');
    Route::get('/pengumuman', [App\Http\Controllers\Ppdb\PpdbController::class, 'pengumuman'])->name('ppdb.pengumuman');
});
