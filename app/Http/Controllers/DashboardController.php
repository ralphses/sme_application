<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Product;
use App\Models\RecentActivity;
use App\Models\SalesOrder;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): Response
    {
        // Fetch the authenticated user
        $user = Auth::user();
        $data = [];
        $recent_sales = [];
        $products = [];
        $view = '';

        // Common business fetching logic
        if (in_array($user->role, [Utils::ROLE_BUSINESS_OWNER, Utils::ROLE_EMPLOYEE])) {
            $business = $user->businesses()->first();

            if ($business) {
                $data = [
                    'total_sales' => SalesOrder::where('business_id', $business->id)->count(),
                    'pending_orders' => SalesOrder::where('business_id', $business->id)
                        ->where('status', 'pending')
                        ->count(),
                    'total_revenue' => SalesOrder::where('business_id', $business->id)
                        ->where('status', 'completed')
                        ->sum('total_amount'),
                ];


                $recent_sales = SalesOrder::where('business_id', $business->id)
                    ->latest()
                    ->take(5)
                    ->get();
            }

            if ($user->role === Utils::ROLE_BUSINESS_OWNER) {
                $data['total_products'] = $business ? Product::where('business_id', $business->id)->count() : 0;

                $products = $business ? Product::where('business_id', $business->id)
                    ->latest()
                    ->take(5)
                    ->get() : [];

                $view = 'dashboard.business_owner';
            } else {
                $view = 'dashboard.employee';
            }

            return response()->view($view, [
                'data' => $data,
                'recent_sales' => $recent_sales,
                'products' => $products
            ]);
        }

        // For other users (e.g., admins)
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
