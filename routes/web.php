<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiKelasController;

Route::get('/', [KelasController::class, 'index'])->name('home');

Route::get('/logincursor', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/logincursor', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.attempt');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/administratifcursor', function () {
    return view('admin');
})->middleware('auth')->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/administratifcursor', [SesiKelasController::class, 'index'])->name('admin');
    Route::post('/administratifcursor/kelas', [SesiKelasController::class, 'store'])->name('admin.kelas.store');

    Route::get('/administratifcursor/kelas/{kelas}/edit', [SesiKelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::put('/administratifcursor/kelas/{kelas}', [SesiKelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/administratifcursor/kelas/{kelas}', [SesiKelasController::class, 'destroy'])->name('admin.kelas.destroy');
});