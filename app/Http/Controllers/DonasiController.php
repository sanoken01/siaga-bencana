<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Donation;

class DonasiController extends Controller
{
    public function create(Report $report)
    {
        return redirect()->route('donasi');
    }

    public function index()
    {
        $reports = Report::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('disaster_type', '!=', '')
            ->where('disaster_status', 'Terjadi')
            ->where(function($query) {
                $query->where('is_confirmed', true)
                      ->orWhere('source', 'BUMN');
            })
            ->latest('report_date')
            ->get();

        $activeDisasters = $reports->map(function (Report $report) {
            $target = $report->goal_amount ?? 0;
            $collected = $report->getTotalDonations();
            $donorCount = $report->donations()->count();

            return [
                'title' => $report->title,
                'location' => $report->location,
                'date' => optional($report->report_date)->format('j F Y') ?? now()->format('j F Y'),
                'target' => $target,
                'collected' => $collected,
                'donors' => $donorCount,
                'tag' => $report->disaster_status === 'Terjadi' ? 'Aktif' : 'Prioritas',
                'icon' => $this->getIconForDisasterType($report->disaster_type),
                'progress' => $report->getDonationPercentage(),
            ];
        })->toArray();

        $donationHistory = [];

        $totalDonations = array_sum(array_column($activeDisasters, 'collected'));
        $totalDonors = array_sum(array_column($activeDisasters, 'donors'));
        $disastersHelped = count($activeDisasters);

        // Pass the raw reports to the view for the dropdown
        $disasterReports = $reports;

        return view('donasi', compact(
            'activeDisasters',
            'disasterReports',
            'donationHistory',
            'totalDonations',
            'totalDonors',
            'disastersHelped'
        ));
    }

    private function getIconForDisasterType($type)
    {
        $type = strtolower($type);

        if (str_contains($type, 'banjir')) {
            return 'fa-water';
        }

        if (str_contains($type, 'gempa')) {
            return 'fa-house-crack';
        }

        if (str_contains($type, 'longsor') || str_contains($type, 'tanah longsor')) {
            return 'fa-mountain-sun';
        }

        if (str_contains($type, 'gunung') || str_contains($type, 'volcano') || str_contains($type, 'vulkan')) {
            return 'fa-volcano';
        }

        if (str_contains($type, 'angin') || str_contains($type, 'badai') || str_contains($type, 'puting')) {
            return 'fa-wind';
        }

        return 'fa-triangle-exclamation';
    }

    public function store(Request $request)
    {
        $amount = preg_replace('/[^0-9]/', '', (string) $request->input('amount'));
        $request->merge(['amount' => $amount]);

        $validated = $request->validate([
            'report_id' => ['required', 'exists:reports,id'],
            'donor_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1000'],
            'payment_method' => ['required', 'in:Transfer Bank,E-Wallet'],
        ], [
            'report_id.required' => 'Bencana wajib dipilih.',
            'report_id.exists' => 'Bencana yang dipilih tidak valid.',
            'donor_name.required' => 'Nama donatur wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'amount.required' => 'Nominal donasi wajib diisi.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
        ]);

        // Persist donation to database
        Donation::create([
            'report_id' => $request->input('report_id'),
            'donor_name' => $validated['donor_name'],
            'email' => $validated['email'],
            'amount' => (int) $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'message' => $request->input('message'),
        ]);

        return redirect()
            ->route('donasi')
            ->with('success', 'Terima kasih, donasi Anda telah diterima. Aksi kecil Anda berdampak besar bagi para korban bencana.');
    }
}