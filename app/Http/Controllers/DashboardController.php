<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Product;
use App\Models\RecentActivity;
use App\Models\SalesOrder;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): Response | RedirectResponse
    {
        // Fetch the authenticated user
        $user = Auth::user();
        $data = [];
        $recent_sales = [];
        $products = [];
        $view = '';
        $pending_orders = 0;
        $total_orders = 0;

        // Common business fetching logic
        if (in_array($user->role, [Utils::ROLE_BUSINESS_OWNER, Utils::ROLE_EMPLOYEE])) {

            $business = $user->businesses()->first();

            if(!$business and $user->role === Utils::ROLE_BUSINESS_OWNER) {
                return redirect(route('dashboard.business.create'));
            }

            if ($business) {
                $data = [
                    'total_sales' => SalesOrder::query()->where('business_id', $business->id)->count(),
                    'pending_orders' => SalesOrder::query()->where('business_id', $business->id)
                        ->where('status', Utils::ORDER_STATUS_PENDING)
                        ->count(),
                    'total_revenue' => SalesOrder::query()->where('business_id', $business->id)
                        ->where('status', Utils::ORDER_STATUS_COMPLETED)
                        ->sum('total_amount'),
                ];


                $recent_sales = SalesOrder::query()->where('business_id', $business->id)
                    ->latest()
                    ->take(5)
                    ->get();


            }

            if ($user->role === Utils::ROLE_BUSINESS_OWNER) {
                $data['total_products'] = $business ? Product::query()->where('business_id', $business->id)->count() : 0;

                $products = $business ? Product::query()->where('business_id', $business->id)
                    ->latest()
                    ->take(5)
                    ->get() : [];

                $view = 'dashboard.business_owner';
            } else {
                $total_orders = SalesOrder::query()->count();;
                $pending_orders = SalesOrder::query()->where('status', Utils::ORDER_STATUS_PENDING)->count();
                $view = 'dashboard.employee';
            }

            return response()->view($view, [
                'data' => $data,
                'recent_sales' => $recent_sales,
                'products' => $products,
                'pending_orders' => $pending_orders,
                'total_orders' => $total_orders,
            ]);
        }

        // For other users (e.g., admins)
        $data = [
            'total_users' => User::query()->count(),
            'active_businesses' => Business::query()->where('status', 'active')->count(),
            'pending_orders' => SalesOrder::query()->where('status', 'pending')->count(),
            'total_revenue' => SalesOrder::query()->where('status', 'completed')->sum('total_amount'),
        ];

        $users = User::query()->latest()->take(5)->get();
        $businesses = Business::query()->latest()->take(5)->get();
        $recent_activities = RecentActivity::query()->latest()->take(5)->get();

        return response()->view('dashboard.home', [
            'data' => $data,
            'users' => $users,
            'businesses' => $businesses,
            'recent_activities' => $recent_activities
        ]);
    }

}
