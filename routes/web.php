<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AdminReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/disaster-data', [ReportController::class, 'getDisasterData']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('admin')->name('admin.dashboard');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');
        Route::patch('/admin/reports/{report}/goal', [AdminReportController::class, 'updateGoal'])->name('admin.report.goal');
    });
});

Route::resource('reports', ReportController::class);
Route::get('reports/{report}/donate', [DonationController::class, 'create'])->name('reports.donate');
Route::post('reports/{report}/donate', [DonationController::class, 'store'])->name('reports.donate.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
