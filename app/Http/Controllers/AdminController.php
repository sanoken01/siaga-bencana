<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $reports = Report::with('user')->latest()->get();
        $donations = Donation::with('report')->latest()->get();
        $users = User::latest()->get();
        
        $stats = [
            'total_reports' => Report::count(),
            'total_donations' => Donation::count(),
            'total_users' => User::count(),
            'total_funds' => Donation::sum('amount') ?? 0,
        ];

        return view('admin.dashboard', compact('reports', 'donations', 'users', 'stats'));
    }
}
