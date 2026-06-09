<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminReportController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $reports = Report::latest('created_at')->get();
        return view('admin.reports', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'disaster_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'report_date' => 'required|date',
            'description' => 'required|string',
            'disaster_status' => 'required|in:Terjadi,Selesai,Prediksi',
            'source' => 'required|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'Diverifikasi';
        $validated['is_confirmed'] = true;

        Report::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Laporan bencana berhasil dibuat!');
    }

    public function updateGoal(Request $request, Report $report)
    {
        $request->validate([
            'goal_amount' => 'required|numeric|min:100000',
        ]);

        $report->update(['goal_amount' => $request->input('goal_amount')]);

        return redirect()->route('admin.dashboard')->with('success', 'Target donasi berhasil diperbarui!');
    }

    public function confirm(Report $report)
    {
        $report->update(['is_confirmed' => true]);

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil dikonfirmasi dan dipublikasikan!');
    }
}
