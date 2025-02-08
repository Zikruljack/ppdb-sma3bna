<?php

use Illuminate\Support\Facades\Route;


//Landing Page
Route::prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing-page');
    Route::get('/profil', [App\Http\Controllers\LandingPageController::class, 'profil'])->name('profil');
    Route::get('/ppdb', [App\Http\Controllers\LandingPageController::class, 'ppdb'])->name('ppdb');
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

Auth::routes();

Route::middleware(['auth'])->group(function () {

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


//ppdb

Route::middleware(['auth', 'ppdbMiddleware'])->group(function () {
    Route::get('/account', [App\Http\Controller\Ppdb\PpdbController::class, 'account'])->name('ppdb.account');
    Route::get('/formulir/{slug}', [App\Http\Controller\Ppdb\PpdbController::class, 'formulir'])->name('ppdb.formulir');
    Route::get('/upload/{slug}', [App\Http\Controller\Ppdb\PpdbController::class, 'upload'])->name('ppdb.upload');
    Route::get('/pengumuman', [App\Http\Controller\Ppdb\PpdbController::class, 'pengumuman'])->name('ppdb.pengumuman');
});
