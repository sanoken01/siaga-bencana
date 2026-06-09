<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $reports = Report::with('user')->latest()->paginate(10, ['*'], 'reports_page');
        $donations = Donation::with('report')->latest()->paginate(10, ['*'], 'donations_page');
        $users = User::latest()->paginate(10, ['*'], 'users_page');
        
        // Tracking data: latest donation per user with disaster info
        $trackingData = User::whereHas('donations')
            ->with(['latestDonation.report'])
            ->latest()
            ->paginate(10, ['*'], 'tracking_page');

        $stats = [
            'total_reports' => Report::count(),
            'total_donations' => Donation::count(),
            'total_users' => User::count(),
            'total_funds' => Donation::sum('amount') ?? 0,
        ];

        return view('admin.dashboard', compact('reports', 'donations', 'users', 'stats', 'trackingData'));
    }

    public function userCreate()
    {
        return view('admin.users.create');
    }

    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil ditambahkan!');
    }
}
