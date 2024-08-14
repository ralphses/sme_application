<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Sale;
use App\Models\SalesOrder;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user is a business owner
        $business = Business::where('user_id', $user->id)->first();

        if ($user->role !== Utils::ROLE_BUSINESS_OWNER) {
            abort(403, 'You are not authorized to view sales orders.');
        }

        // Get the date from the request, default to today's date
        $date = $request->input('date', date('Y-m-d'));

        // Retrieve paginated sales orders for the business on the specified date
        $salesOrders = SalesOrder::where('business_id', $business->id)
            ->whereDate('created_at', $date)
            ->paginate(10); // Adjust the number for the items per page

        return view('dashboard.sale.index', [
            'sales' => $salesOrders,
            'date' => $date,
        ]);
    }


}
