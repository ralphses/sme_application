<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortBy = $request->input('sort_by', 'name'); // Default sort by 'name'

        // Validate the sort parameter
        $validSorts = ['name', 'role', 'status'];
        if (!in_array($sortBy, $validSorts)) {
            $sortBy = 'name';
        }

        $users = User::where('name', 'like', "%{$search}%")
            ->orderBy($sortBy)
            ->paginate(10); // Adjust pagination as needed

        return view('dashboard.user.index', compact('users', 'search', 'sortBy'));
    }

    /**
     * Update the status of a user.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id): RedirectResponse
    {
        try {
            $user = User::findOrFail($id);

            // Toggle the user's status
            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();

            return redirect()->route('dashboard.users')->with('status', 'User status updated successfully!');
        } catch (ModelNotFoundException $e) {
            // Log the exception for further analysis
            Log::error('Failed to update user status', [
                'user_id' => $id,
                'error' => $e->getMessage(),
            ]);

            // Flash an error message to the session
            return redirect()->route('dashboard.users')->with('error', 'Failed to update user status. Please try again.');
        }
    }

}
