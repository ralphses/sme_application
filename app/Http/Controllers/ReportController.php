<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(): Response
    {
        $perPage = 10; // Number of items per page

        $query = Business::query()
            ->with([
                'sales' => function ($query) {
                    $query->select(DB::raw('business_id, SUM(amount) as total_sales'))
                        ->groupBy('business_id');
                },
                'revenues' => function ($query) {
                    $query->select(DB::raw('business_id, SUM(amount) as total_revenue'))
                        ->groupBy('business_id');
                }
            ]);

        // Apply search filter
        if ($search = request('search')) {
            $query->where('name', 'like', "%$search%");
        }

        // Apply sorting
        $sortBy = request('sort_by', 'name'); // Default sort by name
        $validSortColumns = ['name', 'total_sales', 'total_revenue', 'transaction_count'];
        if (in_array($sortBy, $validSortColumns)) {
            $query->getQuery()->orders = [];
            if ($sortBy === 'total_sales') {
                $query->leftJoin('sales', 'businesses.id', '=', 'sales.business_id')
                    ->select('businesses.*', DB::raw('SUM(sales.amount) as total_sales'))
                    ->groupBy('businesses.id')
                    ->orderBy('total_sales', 'desc');
            } elseif ($sortBy === 'total_revenue') {
                $query->leftJoin('revenues', 'businesses.id', '=', 'revenues.business_id')
                    ->select('businesses.*', DB::raw('SUM(revenues.amount) as total_revenue'))
                    ->groupBy('businesses.id')
                    ->orderBy('total_revenue', 'desc');
            } elseif ($sortBy === 'transaction_count') {
                $query->leftJoin('sales', 'businesses.id', '=', 'sales.business_id')
                    ->select('businesses.*', DB::raw('COUNT(sales.id) as transaction_count'))
                    ->groupBy('businesses.id')
                    ->orderBy('transaction_count', 'desc');
            } else {
                $query->orderBy('name');
            }
        } else {
            $query->orderBy('name');
        }

        // Paginate the results
        $businesses = $query->paginate($perPage);

        // Calculate metrics for each business
        foreach ($businesses as $business) {
            $business->total_sales = $business->sales->sum('total_sales');
            $business->total_revenue = $business->revenues->sum('total_revenue');
            $business->transaction_count = $business->sales->count();
        }

        return response()->view('dashboard.report.index', compact('businesses'));
    }

}
