<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Report;

class DonationController extends Controller
{
    public function create(Report $report)
    {
        return view('donations.create', compact('report'));
    }

    public function store(Request $request, Report $report)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string|max:500',
        ]);

        Donation::create([
            'report_id' => $report->id,
            'donor_name' => $request->input('donor_name'),
            'amount' => $request->input('amount'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('reports.index')->with('success', 'Donasi berhasil dicatat. Terima kasih!');
    }
}
