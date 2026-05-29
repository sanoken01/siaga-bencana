<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Report;
use Illuminate\Support\Facades\Validator;

class DonationApiController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only(['donor_name', 'email', 'amount', 'payment_method', 'report_id', 'message']);
        $data['amount'] = preg_replace('/[^0-9]/', '', (string) ($data['amount'] ?? ''));

        $validator = Validator::make($data, [
            'donor_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:10000'],
            'payment_method' => ['required', 'in:Transfer Bank,E-Wallet'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $donation = Donation::create([
            'report_id' => $data['report_id'] ?? null,
            'donor_name' => $data['donor_name'],
            'email' => $data['email'],
            'amount' => (int) $data['amount'],
            'payment_method' => $data['payment_method'],
            'message' => $data['message'] ?? null,
        ]);

        // Build updated stats
        $totalDonations = Donation::sum('amount');
        $totalDonors = Donation::distinct('email')->count('email');
        $totalTransactions = Donation::count();
        $disastersHelped = Report::whereHas('donations')->count();

        return response()->json([
            'success' => true,
            'donation' => [
                'id' => $donation->id,
                'name' => $donation->donor_name,
                'email' => $donation->email,
                'amount' => $donation->amount,
                'payment_method' => $donation->payment_method,
                'date' => $donation->created_at->format('j F Y H:i'),
            ],
            'stats' => [
                'totalDonations' => $totalDonations,
                'totalDonors' => $totalDonors,
                'totalTransactions' => $totalTransactions,
                'disastersHelped' => $disastersHelped,
            ],
        ], 201);
    }

    public function history(Request $request)
    {
        $items = Donation::orderBy('created_at', 'desc')->take(50)->get()->map(function (Donation $d) {
            return [
                'id' => $d->id,
                'name' => $d->donor_name,
                'amount' => $d->amount,
                'payment_method' => $d->payment_method,
                'date' => $d->created_at->format('j F Y H:i'),
            ];
        });

        return response()->json(['success' => true, 'data' => $items]);
    }

    public function stats(Request $request)
    {
        $totalDonations = Donation::sum('amount');
        $totalDonors = Donation::distinct('email')->count('email');
        $totalTransactions = Donation::count();
        $disastersHelped = Report::whereHas('donations')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'totalDonations' => $totalDonations,
                'totalDonors' => $totalDonors,
                'totalTransactions' => $totalTransactions,
                'disastersHelped' => $disastersHelped,
            ]
        ]);
    }

    public function charts(Request $request)
    {
        // Donations per day (last 14 days)
        $days = [];
        $labels = [];
        $today = now()->startOfDay();
        for ($i = 13; $i >= 0; $i--) {
            $day = $today->copy()->subDays($i);
            $labels[] = $day->format('d M');
            $days[] = $day->toDateString();
        }

        $donationsByDay = Donation::selectRaw("DATE(created_at) as date, SUM(amount) as total")
            ->where('created_at', '>=', now()->subDays(13)->startOfDay())
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $series = array_map(function ($d) use ($donationsByDay) {
            return isset($donationsByDay[$d]) ? (int) $donationsByDay[$d] : 0;
        }, $days);

        // Payment method distribution
        $payment = Donation::selectRaw('payment_method, COUNT(*) as cnt')
            ->groupBy('payment_method')
            ->pluck('cnt', 'payment_method')
            ->toArray();

        // Cumulative line for the period
        $cumulative = [];
        $running = 0;
        foreach ($series as $val) {
            $running += $val;
            $cumulative[] = $running;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $labels,
                'donationsPerDay' => $series,
                'paymentMethods' => $payment,
                'cumulative' => $cumulative,
            ]
        ]);
    }
}
