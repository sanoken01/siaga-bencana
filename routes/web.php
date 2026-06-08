<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Static Education Routes
Route::prefix('edukasi')->name('edukasi.')->group(function () {
    Route::get('/tas-siaga', function () { return view('edukasi.tas-siaga'); })->name('tas-siaga');
    Route::get('/gempa', function () { return view('edukasi.gempa'); })->name('gempa');
    Route::get('/peringatan-dini', function () { return view('edukasi.peringatan-dini'); })->name('peringatan-dini');
});

Route::get('/api/disaster-data', [ReportController::class, 'getDisasterData']);
Route::middleware('auth')->group(function () {
    Route::get('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout.get');
    Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi');
    Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin')->name('admin.dashboard');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');
        Route::patch('/admin/reports/{report}/goal', [AdminReportController::class, 'updateGoal'])->name('admin.report.goal');
        Route::patch('/admin/reports/{report}/confirm', [AdminReportController::class, 'confirm'])->name('admin.reports.confirm');

        // News Management
        Route::post('/admin/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
        Route::delete('/admin/news/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
    });
});

Route::middleware('auth')->resource('reports', ReportController::class);

Route::middleware('auth')->group(function () {
    Route::get('reports/{report}/donate', [DonasiController::class, 'create'])->name('reports.donate');
    Route::post('reports/{report}/donate', [DonasiController::class, 'store'])->name('reports.donate.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
