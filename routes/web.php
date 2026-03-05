<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Km\KelasController as KmKelasController;
use App\Http\Controllers\Km\MomentController as KmMomentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MomentController;


// Route untuk user biasa (guest)
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/pohon', [HomeController::class, 'pohon'])->name('pohon');

Route::get('/kelas/{id}', [KelasController::class, 'show'])
    ->name('kelas.siswa');


Route::get('/kelas/{id}/gambar', [MomentController::class, 'index'])
    ->name('kelas.moments');


// Route untuk admin (CRUD)

Route::middleware(['auth', 'role:admin'])->group(function () {
    // artikel
    Route::get('/admin/articles', [ArticleController::class, 'index'])
        ->name('articles.index');

    Route::post('/admin/articles', [ArticleController::class, 'store'])
        ->name('articles.store');

    Route::put('/admin/articles/{id}', [ArticleController::class, 'update'])
        ->name('articles.update');

    Route::delete('/admin/articles/{id}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');

    // pohon
    Route::get('/admin/trees', [TreeController::class, 'adminIndex'])
        ->name('admin.trees.index');
    Route::post('/admin/trees', [TreeController::class, 'store'])
        ->name('trees.store');
    Route::put('/admin/trees/{id}', [TreeController::class, 'update'])
        ->name('trees.update');
    Route::delete('/admin/trees/{id}', [TreeController::class, 'destroy'])
        ->name('trees.destroy');

    //anggota
    Route::get('/admin/members', [MemberController::class, 'adminIndex'])
        ->name('admin.members.index');
    Route::post('/admin/members', [MemberController::class, 'store'])
        ->name('admin.members.store');
    Route::put('/admin/members/{id}', [MemberController::class, 'update'])
        ->name('admin.members.update');
    Route::delete('/admin/members/{id}', [MemberController::class, 'destroy'])
        ->name('admin.members.destroy');

    //generator qr
    // QR Code Generator
    Route::get('/admin/qrcode', function () {
        return view('admin.qrcode');
    })->name('admin.qrcode');

    Route::post('/admin/qrcode', [\App\Http\Controllers\QrController::class, 'generate'])
        ->name('admin.qrcode.generate');
    Route::get('/admin/qrcode', [QrController::class, 'index'])->name('admin.qrcode.index');
    Route::post('/admin/qrcode', [QrController::class, 'generate'])->name('admin.qrcode.generate');
});

Route::middleware(['auth', 'role:km'])
    ->prefix('ketua_murid')
    ->name('km.')
    ->group(function () {

        // Kelas
        Route::get('/kelas/{id}', [KmKelasController::class, 'show'])
            ->name('kelas.show');

        Route::put(
            '/kelas/{id}/moment-bg',
            [KmKelasController::class, 'updateMomentBg']
        )
            ->name('kelas.updateMomentBg');

        Route::put(
            '/kelas/{id}/siswa-bg',
            [KmKelasController::class, 'updateSiswaBg']
        )
            ->name('kelas.updateSiswaBg');

        // Siswa
        Route::resource('siswa', KmKelasController::class);

        // Moments
        Route::prefix('moments')->group(function () {
            Route::get('{id}', [KmMomentController::class, 'show'])
                ->name('moments.show');

            Route::post('/', [KmMomentController::class, 'store'])
                ->name('moments.store');

            Route::put('{id}', [KmMomentController::class, 'update'])
                ->name('moments.update');

            Route::delete('{id}', [KmMomentController::class, 'destroy'])
                ->name('moments.destroy');
        });
    });



// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
