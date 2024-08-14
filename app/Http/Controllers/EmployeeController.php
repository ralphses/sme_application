<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Employee;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user is a business owner
        $business = Business::where('user_id', $user->id)->first();

        if ($user->role !== Utils::ROLE_BUSINESS_OWNER) {
            abort(403, 'You are not authorized to view employees.');
        }

        // Retrieve search and sort parameters
        $search = $request->input('search');
        $sortBy = $request->input('sort_by');

        // Start building the query
        $query = Employee::where('business_id', $business->id);

        // Apply search filter if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            });
        }

        // Apply sorting if provided
        if ($sortBy) {
            switch ($sortBy) {
                case 'name':
                    $query->join('users', 'employees.user_id', '=', 'users.id')
                        ->orderBy('users.name');
                    break;
                case 'email':
                    $query->join('users', 'employees.user_id', '=', 'users.id')
                        ->orderBy('users.email');
                    break;
                case 'role':
                    $query->join('users', 'employees.user_id', '=', 'users.id')
                        ->orderBy('users.role');
                    break;
                case 'business':
                    $query->join('businesses', 'employees.business_id', '=', 'businesses.id')
                        ->orderBy('businesses.name');
                    break;
                default:
                    // Default sorting if no valid sort_by parameter is provided
                    $query->orderBy('id');
                    break;
            }
        } else {
            // Default sorting
            $query->orderBy('id');
        }

        // Paginate the results
        $employees = $query->paginate(10); // Adjust the number of items per page as needed

        return view('dashboard.employee.index', [
            'employees' => $employees,
        ]);
    }

    public function create()
    {
        return view('dashboard.employee.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:employee',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.employee')
                ->withErrors($validator)
                ->withInput();
        }

        // Get the authenticated user
        $user = Auth::user();
        $business = Business::where('user_id', $user->id)->first();

        // Create a new user
        $newUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        // Create a new employee
        Employee::create([
            'user_id' => $newUser->id,
            'business_id' => $business->id,
        ]);

        return redirect()->route('dashboard.employee')
            ->with('success', 'Employee added successfully.');
    }


}
