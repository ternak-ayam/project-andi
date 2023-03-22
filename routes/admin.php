<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user', [UserController::class, 'store'])->name('user.store');
        Route::put('user/{admin}', [UserController::class, 'update'])->name('user.update');
        Route::get('user/{admin}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::get('user/{admin}/delete', [UserController::class, 'destroy'])->name('user.destroy');

        Route::prefix('barang')->as('barang.')->group(function () {
            Route::get('/kelola', [\App\Http\Controllers\BarangController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\BarangController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\BarangController::class, 'store'])->name('store');

            Route::get('masuk', [\App\Http\Controllers\BarangMasukController::class, 'index'])->name('masuk.index');
            Route::get('masuk/create', [\App\Http\Controllers\BarangMasukController::class, 'create'])->name('masuk.create');

            Route::get('keluar', [\App\Http\Controllers\BarangKeluarController::class, 'index'])->name('keluar.index');
            Route::get('keluar/create', [\App\Http\Controllers\BarangKeluarController::class, 'create'])->name('keluar.create');

            Route::get('laporan', [\App\Http\Controllers\LaporanBarangController::class, 'index'])->name('laporan.index');
        });
    });
});
