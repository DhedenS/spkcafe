<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCafeController;
use App\Http\Controllers\PemilikCafeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerhitunganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/rekomendasi', [LandingController::class, 'rekomendasi'])->name('rekomendasi');
Route::get('/cafe/{id}', [LandingController::class, 'detail'])->name('cafe.detail');
Route::get('/data-cafe', [LandingController::class, 'dataCafe'])->name('data.cafe');
Route::get('/data-cafe/{id}', [LandingController::class, 'detailCafe'])->name('data.cafe.detail');
Route::post('/rekomendasi/ajax', [LandingController::class, 'rekomendasiAjax'])->name('rekomendasi.ajax');
Route::get('/cafe-detail/{id}', [LandingController::class, 'cafeDetailAjax'])->name('cafe.detail.ajax');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('pemilik.cafe');
    })->name('dashboard');

    Route::middleware(['auth', 'role:admin', 'no-cache'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
        Route::get('/admin/users', [AdminUserController::class, 'index'])
            ->name('admin.users');
        Route::post('/admin/users/{id}/approve', [AdminUserController::class, 'approve'])
            ->name('admin.users.approve');
        Route::post('/admin/users/{id}/reject', [AdminUserController::class, 'reject'])
            ->name('admin.users.reject');
        Route::delete('/admin/users/delete/{id}', [AdminUserController::class, 'destroy'])
            ->name('admin.users.delete');
        Route::get('/admin/cafe', [AdminCafeController::class, 'index'])
            ->name('admin.cafe');
        Route::post('/admin/cafe/{id}/approve', [AdminCafeController::class, 'approve'])
            ->name('admin.cafe.approve');
        Route::post('/admin/cafe/{id}/reject', [AdminCafeController::class, 'reject'])
            ->name('admin.cafe.reject');
        Route::delete('/admin/cafe/delete/{id}', [AdminCafeController::class, 'deleteCafe'])
            ->name('admin.cafe.delete');
        Route::get('/admin/kriteria', [KriteriaController::class, 'index'])
            ->name('admin.kriteria');
        Route::get('/admin/perhitungan', [PerhitunganController::class, 'index'])
            ->name('admin.perhitungan');
        Route::get('/admin/perhitungan/{id}/detail', [PerhitunganController::class, 'detail'])
            ->name('admin.perhitungan.detail');
        Route::get('/admin/history', [HistoryController::class, 'index'])
            ->name('admin.history');
        Route::get('/admin/history/{id}/detail', [HistoryController::class, 'detail'])
            ->name('admin.history.detail');
    });
    Route::middleware(['auth', 'role:pemilik', 'no-cache'])->group(function () {
        Route::get('/pemilik/cafe', [PemilikCafeController::class, 'index'])
            ->name('pemilik.cafe');
        Route::get('/pemilik/cafe/create', [PemilikCafeController::class, 'create'])
            ->name('pemilik.cafe.create');
        Route::post('/pemilik/cafe', [PemilikCafeController::class, 'store'])
            ->name('pemilik.cafe.store');
        Route::get('/pemilik/cafe/{id}/edit', [PemilikCafeController::class, 'edit'])
            ->name('pemilik.cafe.edit');
        Route::put('/pemilik/cafe/{id}', [PemilikCafeController::class, 'update'])
            ->name('pemilik.cafe.update');
        Route::delete('/pemilik/cafe/{id}',[PemilikCafeController::class, 'destroy'])
            ->name('pemilik.cafe.destroy');
    });
});
require __DIR__ . '/auth.php';
