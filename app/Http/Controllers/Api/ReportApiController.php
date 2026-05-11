<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportApiController extends Controller
{
    /**
     * Display a listing of all reports.
     * GET /api/reports
     */
    public function index(Request $request)
    {
        try {
            $query = Report::query();

            // Filter by disaster_type if provided
            if ($request->has('disaster_type')) {
                $query->where('disaster_type', $request->get('disaster_type'));
            }

            // Filter by disaster_status if provided
            if ($request->has('disaster_status')) {
                $query->where('disaster_status', $request->get('disaster_status'));
            }

            // Filter by source if provided
            if ($request->has('source')) {
                $query->where('source', $request->get('source'));
            }

            // Filter by location if provided
            if ($request->has('location')) {
                $query->where('location', 'like', '%' . $request->get('location') . '%');
            }

            // Sort by report_date descending by default
            $query->latest('report_date');

            // Pagination
            $perPage = $request->get('per_page', 20);
            $reports = $query->paginate($perPage);

            return response()->json([
                'status' => 'success',
                'message' => 'Reports retrieved successfully',
                'data' => $reports->items(),
                'pagination' => [
                    'total' => $reports->total(),
                    'per_page' => $reports->perPage(),
                    'current_page' => $reports->currentPage(),
                    'last_page' => $reports->lastPage(),
                ],
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve reports',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created report.
     * POST /api/reports
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'disaster_type' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'report_date' => 'required|date',
                'description' => 'required|string',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'status' => 'nullable|in:Diproses,Diverifikasi,Selesai',
                'disaster_status' => 'nullable|in:Terjadi,Prediksi,Selesai',
                'goal_amount' => 'nullable|numeric|min:0',
                'prediction_percentage' => 'nullable|integer|min:0|max:100',
            ]);

            $report = Report::create(array_merge(
                $validated,
                [
                    'source' => 'API',
                    'disaster_status' => $validated['disaster_status'] ?? 'Prediksi',
                    'status' => $validated['status'] ?? 'Diproses',
                ]
            ));

            return response()->json([
                'status' => 'success',
                'message' => 'Report created successfully',
                'data' => $report,
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create report',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified report.
     * GET /api/reports/{id}
     */
    public function show($id)
    {
        try {
            $report = Report::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Report retrieved successfully',
                'data' => $report,
            ], Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report not found',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve report',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified report.
     * PUT /api/reports/{id}
     */
    public function update(Request $request, $id)
    {
        try {
            $report = Report::findOrFail($id);

            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'disaster_type' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'report_date' => 'nullable|date',
                'description' => 'nullable|string',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'status' => 'nullable|in:Diproses,Diverifikasi,Selesai',
                'disaster_status' => 'nullable|in:Terjadi,Prediksi,Selesai',
                'goal_amount' => 'nullable|numeric|min:0',
                'prediction_percentage' => 'nullable|integer|min:0|max:100',
            ]);

            $report->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Report updated successfully',
                'data' => $report,
            ], Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report not found',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update report',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified report.
     * DELETE /api/reports/{id}
     */
    public function destroy($id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Report deleted successfully',
                'data' => [
                    'id' => $id,
                    'deleted_at' => now(),
                ],
            ], Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report not found',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete report',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get reports by disaster type.
     * GET /api/reports/type/{disaster_type}
     */
    public function getByType($type)
    {
        try {
            $reports = Report::where('disaster_type', $type)
                ->latest('report_date')
                ->paginate(20);

            return response()->json([
                'status' => 'success',
                'message' => "Reports of type '{$type}' retrieved successfully",
                'data' => $reports->items(),
                'pagination' => [
                    'total' => $reports->total(),
                    'per_page' => $reports->perPage(),
                    'current_page' => $reports->currentPage(),
                    'last_page' => $reports->lastPage(),
                ],
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve reports by type',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get active/ongoing reports.
     * GET /api/reports/status/active
     */
    public function getActive()
    {
        try {
            $reports = Report::where('disaster_status', 'Terjadi')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->latest('report_date')
                ->paginate(20);

            return response()->json([
                'status' => 'success',
                'message' => 'Active reports retrieved successfully',
                'data' => $reports->items(),
                'pagination' => [
                    'total' => $reports->total(),
                    'per_page' => $reports->perPage(),
                    'current_page' => $reports->currentPage(),
                    'last_page' => $reports->lastPage(),
                ],
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve active reports',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get report statistics.
     * GET /api/reports/stats/overview
     */
    public function getStatistics()
    {
        try {
            $totalReports = Report::count();
            $activeReports = Report::where('disaster_status', 'Terjadi')->count();
            $completedReports = Report::where('disaster_status', 'Selesai')->count();
            $predictedReports = Report::where('disaster_status', 'Prediksi')->count();

            $byType = Report::select('disaster_type')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('disaster_type')
                ->get();

            $byStatus = Report::select('disaster_status')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('disaster_status')
                ->get();

            $bySource = Report::select('source')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('source')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Statistics retrieved successfully',
                'data' => [
                    'total_reports' => $totalReports,
                    'active_reports' => $activeReports,
                    'completed_reports' => $completedReports,
                    'predicted_reports' => $predictedReports,
                    'by_type' => $byType,
                    'by_status' => $byStatus,
                    'by_source' => $bySource,
                ],
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve statistics',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
