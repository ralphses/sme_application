<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
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
    public function index(Request $request): View
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

    /**
     * Show the form for creating a new business.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.business.create');
    }

    /**
     * Store a newly created business in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
        ]);

        // Create the new business
        Business::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('dashboard')->with('status', 'Business created successfully!');
    }

    /**
     * Show the form for editing the specified business.
     *
     * @param int $id
     * @return View
     */
    public function edit($id): View
    {
        $business = Business::findOrFail($id);
        return view('dashboard.business.edit', compact('business'));
    }

    /**
     * Update the specified business in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
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

    /**
     * Toggle the status of a business.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
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
