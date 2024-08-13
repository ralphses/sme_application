<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BusinessController extends Controller
{
    /**
     * Display a listing of the businesses.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        // Retrieve search and sort parameters
        $search = $request->input('search', '');
        $sortBy = $request->input('sort_by', 'name');

        // Build the query
        $query = Business::query();

        // Apply search filter
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Apply sorting
        if (in_array($sortBy, ['name', 'category', 'status'])) {
            $query->orderBy($sortBy);
        }

        // Paginate results
        $businesses = $query->paginate(10)->appends([
            'search' => $search,
            'sort_by' => $sortBy
        ]);

        // Pass data to the view
        return view('dashboard.business.index', [
            'businesses' => $businesses,
            'search' => $search,
            'sortBy' => $sortBy
        ]);
    }

    // Show the form for editing the specified business
    public function edit($id)
    {
        $business = Business::findOrFail($id);
        return view('dashboard.business.edit', compact('business'));
    }

    // Update the specified business in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $business = Business::findOrFail($id);
        $business->name = $request->input('name');
        $business->status = $request->input('status');
        $business->save();

        return redirect()->route('dashboard.business')->with('status', 'Business updated successfully!');
    }

    // Toggle the status of a business
    public function updateStatus(Request $request, $id)
    {
        try {
            $business = Business::findOrFail($id);

            // Toggle the business's status
            $business->status = $business->status === 'active' ? 'inactive' : 'active';
            $business->save();

            return redirect()->route('dashboard.business')->with('status', 'Business status updated successfully!');
        } catch (ModelNotFoundException $e) {
            Log::error('Failed to update business status', [
                'business_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('dashboard.business')->with('error', 'Failed to update business status. Please try again.');
        }
    }
}
