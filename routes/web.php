<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ {
    RegisterController,
    LoginController,
    LogoutController,
};

use App\Http\Controllers\Magang\ {
    AdminController,
    LamaranController,
    LowonganController,
    MitraController
};

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login'])->name('login-proses');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-proses', [RegisterController::class, 'register'])->name('register-proses');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Lowongan
Route::get('/lowongan', [LowonganController::class, 'lowongan'])->name('lowongan');
Route::get('/lowongan/{lowongan}/show', [LowonganController::class, 'lowonganShow'])->name('lowonganShow');

// content setelah login
Route::group(['middleware' => ['auth']], function() {
    // Admin
    // User 
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::get('/user-tambah', [AdminController::class, 'userTambah'])->name('userTambah');
    Route::post('/user-store', [AdminController::class, 'userStore'])->name('userStore');
    Route::get('/user/{user}/edit', [AdminController::class, 'userEdit'])->name('userEdit');
    Route::put('/user/{user}/update', [AdminController::class, 'userUpdate'])->name('userUpdate');
    Route::delete('/user/{user}/hapus', [AdminController::class, 'userHapus'])->name('userHapus');

    // Type
    Route::get('/type', [AdminController::class, 'type'])->name('type');
    Route::get('/type-tambah', [AdminController::class, 'typeTambah'])->name('typeTambah');
    Route::post('/type-store', [AdminController::class, 'typeStore'])->name('typeStore');
    Route::get('/type/{type}/edit', [AdminController::class, 'typeEdit'])->name('typeEdit');
    Route::put('/type/{type}/update', [AdminController::class, 'typeUpdate'])->name('typeUpdate');
    Route::delete('/type/{type}/hapus', [AdminController::class, 'typeHapus'])->name('typeHapus');

    // Jenjang
    Route::get('/jenjang', [AdminController::class, 'jenjang'])->name('jenjang');
    Route::get('/jenjang-tambah', [AdminController::class, 'jenjangTambah'])->name('jenjangTambah');
    Route::post('/jenjang-store', [AdminController::class, 'jenjangStore'])->name('jenjangStore');
    Route::get('/jenjang/{jenjang}/edit', [AdminController::class, 'jenjangEdit'])->name('jenjangEdit');
    Route::put('/jenjang/{jenjang}/update', [AdminController::class, 'jenjangUpdate'])->name('jenjangUpdate');
    Route::delete('/jenjang/{jenjang}/hapus', [AdminController::class, 'jenjangHapus'])->name('jenjangHapus');

    // Keahlian
    Route::get('/keahlian', [AdminController::class, 'keahlian'])->name('keahlian');
    Route::get('/keahlian-tambah', [AdminController::class, 'keahlianTambah'])->name('keahlianTambah');
    Route::post('/keahlian-store', [AdminController::class, 'keahlianStore'])->name('keahlianStore');
    Route::get('/keahlian/{keahlian}/edit', [AdminController::class, 'keahlianEdit'])->name('keahlianEdit');
    Route::put('/keahlian/{keahlian}/update', [AdminController::class, 'keahlianUpdate'])->name('keahlianUpdate');
    Route::delete('/keahlian/{keahlian}/hapus', [AdminController::class, 'keahlianHapus'])->name('keahlianHapus');

    // Mitra
    Route::get('/mitra', [MitraController::class, 'mitra'])->name('mitra');
    Route::get('/mitra-tambah', [MitraController::class, 'mitraTambah'])->name('mitraTambah');
    Route::post('/mitra-store', [MitraController::class, 'mitraStore'])->name('mitraStore');
    Route::get('/mitra/{mitra}/edit', [MitraController::class, 'mitraEdit'])->name('mitraEdit');
    Route::put('/mitra/{mitra}/update', [MitraController::class, 'mitraUpdate'])->name('mitraUpdate');
    Route::delete('/mitra/{mitra}/hapus', [MitraController::class, 'mitraHapus'])->name('mitraHapus');

    // Lamaran
    Route::post('/lowongan/{lowongan}/lamaran', [LamaranController::class, 'lamaran'])->name('lamaran');
    Route::get('/lamaran', [LamaranController::class, 'lamar'])->name('lamar');
    Route::get('/lamaran/{lamaran}/preview', [LamaranController::class, 'lamarPreview'])->name('lamarPreview');
    Route::get('/lamaran/{lamaran}/edit', [LamaranController::class, 'lamarEdit'])->name('lamarEdit');
    Route::put('/lamaran/{lamaran}/update', [LamaranController::class, 'lamarUpdate'])->name('lamarUpdate');
    Route::delete('/lamaran/{lamaran}/hapus', [LamaranController::class, 'lamarHapus'])->name('lamarHapus');
});