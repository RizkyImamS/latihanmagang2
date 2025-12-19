<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;

// --- FRONT END ---
Route::get('/', [FrontController::class, 'index']); // Beranda
Route::get('/berita', [FrontController::class, 'semua_berita']); // List Berita
Route::get('/berita/{slug}', [FrontController::class, 'detail']); // Detail

// --- AUTH ---
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login_proses']);

// --- BACK END (ADMIN) ---
Route::middleware(['auth_admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD User & Berita (Resource otomatis mencakup index, create, store, edit, update, destroy)
    Route::resource('admin/user', UserController::class);
    Route::resource('admin/berita', BeritaController::class);

    // Kategori Berita (Menggunakan BeritaController sesuai permintaan sebelumnya)
    Route::get('admin/kategori', [BeritaController::class, 'kategori'])->name('kategori.index');
    Route::post('admin/kategori', [BeritaController::class, 'kategori_store'])->name('kategori.store');
    Route::delete('admin/kategori/{id}', [BeritaController::class, 'kategori_destroy'])->name('kategori.destroy');
    Route::get('/admin/kategori/{id}/edit', [BeritaController::class, 'kategori_edit'])
        ->name('berita.kategori_edit');

    Route::put('/admin/kategori/{id}', [BeritaController::class, 'kategori_update'])
        ->name('kategori.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
