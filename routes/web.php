<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MemberController;

// Route untuk user biasa (guest)
Route::get('/', [TreeController::class, 'index']);
Route::get('/trees/{id}', [TreeController::class, 'show']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('/members', [MemberController::class, 'index']);
Route::get('/sejarah', function () {
    return view('sejarah');
});
Route::get('/trees/{id}', [TreeController::class, 'show'])
    ->name('trees.show');
// Route untuk admin (CRUD)
Route::middleware(['auth', 'admin'])->group(function () {
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
});





// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
