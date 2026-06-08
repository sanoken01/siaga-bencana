<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $reports = Report::with('user')->latest()->paginate(10, ['*'], 'reports_page');
        $donations = Donation::with('report')->latest()->paginate(10, ['*'], 'donations_page');
        $users = User::latest()->paginate(10, ['*'], 'users_page');
        
        $stats = [
            'total_reports' => Report::count(),
            'total_donations' => Donation::count(),
            'total_users' => User::count(),
            'total_funds' => Donation::sum('amount') ?? 0,
        ];

        return view('admin.dashboard', compact('reports', 'donations', 'users', 'stats'));
    }
}
