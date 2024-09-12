<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Product;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is a business owner
        $user = auth()->user();

        if ($user->role === Utils::ROLE_BUSINESS_OWNER) {
            // Get business IDs owned by the user
            $businessIds = $user->businesses->pluck('id');

            // Retrieve products for these businesses
            $query = Product::whereIn('business_id', $businessIds);

            // Handle search
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where('name', 'like', "%{$search}%");
            }

            // Handle sorting
            $sortBy = $request->input('sort_by', 'name');
            $validSortFields = ['name', 'price', 'quantity'];
            if (in_array($sortBy, $validSortFields)) {
                $query->orderBy($sortBy);
            }

            // Fetch products with pagination
            $products = $query->paginate(10);

            return view('dashboard.product.index', [
                'products' => $products,
                'search' => $request->input('search'),
                'sortBy' => $sortBy
            ]);
        } else {
            // Redirect or show an error if the user is not a business owner
            return redirect()->route('home')->withErrors('You are not authorized to view this page.');
        }
    }

    public function create()
    {
        // Ensure the user is a business owner
        return view('dashboard.product.add-product');
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
            ]);


            // Get the authenticated user's business
            $business = Business::where('user_id', Auth::id())->firstOrFail();

            // Create the new product
            Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'business_id' => $business->id,
            ]);
        }catch (ModelNotFoundException $exception) {
            dd($exception->getMessage());
        }


        return redirect()->route('dashboard.products')->with('success', 'Product added successfully.');
    }
}
