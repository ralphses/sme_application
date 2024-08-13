<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\RecentActivity;
use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): Response
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Initialize data arrays
        $data = [
            'total_users' => User::count(),
            'active_businesses' => Business::where('status', 'active')->count(),
            'pending_orders' => SalesOrder::where('status', 'pending')->count(),
            'total_revenue' => SalesOrder::where('status', 'completed')->sum('total_amount'),
        ];

        $users = User::latest()->take(5)->get();
        $businesses = Business::latest()->take(5)->get();
        $recent_activities = RecentActivity::latest()->take(5)->get();

        return response()->view('dashboard.home', [
            'data' => $data,
            'users' => $users,
            'businesses' => $businesses,
            'recent_activities' => $recent_activities
        ]);

    }
}
