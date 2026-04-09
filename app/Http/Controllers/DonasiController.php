<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        $activeDisasters = [
            [
                'title' => 'Banjir di Jawa Timur',
                'location' => 'Kab. Pasuruan, Jawa Timur',
                'date' => '8 April 2026',
                'target' => 250000000,
                'collected' => 168500000,
                'donors' => 1240,
                'tag' => 'Aktif',
                'icon' => 'fa-water',
            ],
            [
                'title' => 'Gempa di Sulawesi Tengah',
                'location' => 'Palu, Sulawesi Tengah',
                'date' => '6 April 2026',
                'target' => 300000000,
                'collected' => 197300000,
                'donors' => 1582,
                'tag' => 'Darurat',
                'icon' => 'fa-house-crack',
            ],
            [
                'title' => 'Tanah Longsor di Jawa Barat',
                'location' => 'Garut, Jawa Barat',
                'date' => '4 April 2026',
                'target' => 180000000,
                'collected' => 92500000,
                'donors' => 860,
                'tag' => 'Prioritas',
                'icon' => 'fa-mountain-sun',
            ],
        ];

        foreach ($activeDisasters as &$disaster) {
            $disaster['progress'] = $disaster['target'] > 0
                ? min(100, (int) round(($disaster['collected'] / $disaster['target']) * 100))
                : 0;
        }
        unset($disaster);

        $donationHistory = [
            ['name' => 'Ayu Lestari', 'amount' => 100000, 'date' => '8 April 2026'],
            ['name' => 'Budi Santoso', 'amount' => 50000, 'date' => '8 April 2026'],
            ['name' => 'Siti Rahma', 'amount' => 250000, 'date' => '7 April 2026'],
            ['name' => 'Dimas Pratama', 'amount' => 75000, 'date' => '7 April 2026'],
        ];

        $totalDonations = array_sum(array_column($activeDisasters, 'collected'));
        $totalDonors = array_sum(array_column($activeDisasters, 'donors'));
        $disastersHelped = count($activeDisasters);

        return view('donasi', compact(
            'activeDisasters',
            'donationHistory',
            'totalDonations',
            'totalDonors',
            'disastersHelped'
        ));
    }

    public function store(Request $request)
    {
        $amount = preg_replace('/[^0-9]/', '', (string) $request->input('amount'));
        $request->merge(['amount' => $amount]);

        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1000'],
            'payment_method' => ['required', 'in:Transfer Bank,E-Wallet'],
        ], [
            'donor_name.required' => 'Nama donatur wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'amount.required' => 'Nominal donasi wajib diisi.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
        ]);

        return redirect()
            ->route('donasi')
            ->with('success', 'Terima kasih, donasi Anda telah diterima. Aksi kecil Anda berdampak besar bagi para korban bencana.');
    }
}