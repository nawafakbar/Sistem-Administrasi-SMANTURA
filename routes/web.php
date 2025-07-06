<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CetakKelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalKelasController;
use App\Http\Controllers\SiswaKelasController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleAdmin;

Route::get('/', [BeritaController::class, 'index'])->name('index');
Route::get('/home', function () {
    return redirect('/');
})->name('home');

//route logout
Route::post('/logout2', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout2');


Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.detail');

Route::get('/admin/lihat-kelas/cetak-pdf', [CetakKelasController::class, 'cetakPDF'])
    ->name('lihat-kelas.cetak-pdf');

// Pendaftaran Siswa
Route::get('/pendaftaran', [SiswaController::class, 'create'])->name('siswa.create')->middleware('auth');
Route::post('/pendaftaran', [SiswaController::class, 'store'])->name('siswa.store')->middleware('auth');

//jadwal kelas
Route::get('/jadwal-kelas', [JadwalKelasController::class, 'index'])->name('jadwal.kelas');

//daftar kelas
Route::get('/daftar-kelas', [SiswaKelasController::class, 'index'])->name('daftar.kelas');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
