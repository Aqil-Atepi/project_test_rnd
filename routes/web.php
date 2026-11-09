<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SesiKelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KelasController::class, 'index'])->name('home');

Route::post('/checkin', [AttendanceController::class, 'checkIn'])
    ->middleware('throttle:20,1')
    ->name('attendance.checkin');

Route::post('/checkout', [AttendanceController::class, 'checkOut'])
    ->middleware('throttle:20,1')
    ->name('attendance.checkout');

Route::get('/logincursor', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/logincursor', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.attempt');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/administratifcursor', [SesiKelasController::class, 'index'])->name('admin');
    Route::post('/administratifcursor/kelas', [SesiKelasController::class, 'store'])->name('admin.kelas.store');

    Route::get('/administratifcursor/kelas/{kelas}/edit', [SesiKelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::put('/administratifcursor/kelas/{kelas}', [SesiKelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/administratifcursor/kelas/{kelas}', [SesiKelasController::class, 'destroy'])->name('admin.kelas.destroy');
});