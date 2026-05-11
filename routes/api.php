<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReportApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->group(function () {
    // Public API Routes - No authentication required

    /**
     * Reports API CRUD Routes
     * Base URL: /api/v1/reports
     */
    Route::prefix('v1')->group(function () {
        // Get all reports with filters and pagination
        Route::get('/reports', [ReportApiController::class, 'index'])->name('api.reports.index');

        // Create a new report
        Route::post('/reports', [ReportApiController::class, 'store'])->name('api.reports.store');

        // Get a specific report by ID
        Route::get('/reports/{id}', [ReportApiController::class, 'show'])->name('api.reports.show');

        // Update a report
        Route::put('/reports/{id}', [ReportApiController::class, 'update'])->name('api.reports.update');

        // Delete a report
        Route::delete('/reports/{id}', [ReportApiController::class, 'destroy'])->name('api.reports.destroy');

        // Get reports by disaster type
        Route::get('/reports/type/{type}', [ReportApiController::class, 'getByType'])->name('api.reports.by-type');

        // Get active/ongoing reports
        Route::get('/reports/status/active', [ReportApiController::class, 'getActive'])->name('api.reports.active');

        // Get statistics overview
        Route::get('/statistics/overview', [ReportApiController::class, 'getStatistics'])->name('api.statistics');
    });
});
