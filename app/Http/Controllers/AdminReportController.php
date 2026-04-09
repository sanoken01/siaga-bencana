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

    public function updateGoal(Request $request, Report $report)
    {
        $request->validate([
            'goal_amount' => 'required|numeric|min:100000',
        ]);

        $report->update(['goal_amount' => $request->input('goal_amount')]);

        return redirect()->route('admin.reports')->with('success', 'Target donasi berhasil diperbarui!');
    }
}
