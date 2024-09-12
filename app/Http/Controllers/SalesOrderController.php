<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Employee;
use App\Models\PaymentMethodOption;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Utils\Utils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Ensure the user is an employee
        if ($user->role !== Utils::ROLE_EMPLOYEE) {
            abort(403, 'You are not authorized to view sales orders.');
        }

        $employee = Employee::query()->where('user_id', $user->id)->first();

        // Fetch the business associated with the employee
        $business = Business::find($employee->business_id);
//        dd($business);


        // Query sales orders that belong to the employee's business
        $query = SalesOrder::where('business_id', $business->id);

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $query->where('order_number', 'LIKE', '%' . $request->search . '%');
        }

        // Apply sort by filter
        if ($request->has('sort_by') && !empty($request->sort_by)) {
            $query->orderBy($request->sort_by, $request->get('order', 'asc'));
        } else {
            $query->latest();
        }

        // Paginate the results using custom pagination
        $salesOrders = $query->paginate(10)->withQueryString();

//        dd($salesOrders->items());

        return view('dashboard.order.index', compact('salesOrders'));
    }


    public function create(): Response
    {
        // Fetch the authenticated user
        $user = Auth::user();


        // Ensure the user is an employee
        if ($user->role !== Utils::ROLE_EMPLOYEE) {
            abort(403, 'You are not authorized to create sales orders.');
        }

        $employee = Employee::query()->where('user_id', $user->id)->first();

        // Fetch the business associated with the employee
        $business = Business::find($employee->business_id);
//        dd($business);

        // Fetch products and payment method options belonging to the business
        $products = Product::where('business_id', $business->id)->get();
        $paymentMethods = PaymentMethodOption::where('business_id', $business->id)->get();

        // Return the view with products and payment methods to load in the form
        return response()->view('dashboard.order.add', [
            'products' => $products,
            'paymentMethods' => $paymentMethods
        ]);
    }


    public function store(Request $request): RedirectResponse
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Ensure the user is an employee
        if ($user->role !== Utils::ROLE_EMPLOYEE) {
            abort(403, 'You are not authorized to create sales orders.');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'payment_method_id' => 'required|exists:payment_method_options,id',
        ]);

        // Fetch the business associated with the employee
        $business = $user->businesses()->first();

        // Initialize total amount
        $totalAmount = 0;

        // Create the new sales order
        $salesOrder = new SalesOrder();
        $salesOrder->business_id = $business->id;
        $salesOrder->user_id = $user->id;
        $salesOrder->payment_method_options_id = $validatedData['payment_method_id'];
        $salesOrder->status = Utils::ORDER_STATUS_COMPLETED; // Default status
        $salesOrder->order_date = now();
        $salesOrder->total_amount = 0;
        $salesOrder->save();

        // Add products to the order and calculate total amount
        foreach ($validatedData['products'] as $productData) {
            $product = Product::where('business_id', $business->id)
                ->where('id', $productData['product_id'])
                ->firstOrFail();

            // Calculate the total price for this product
            $productTotal = $product->price * $productData['quantity'];
            $totalAmount += $productTotal;

            // Save the order item
            $salesOrderItem = new SalesOrderItem();
            $salesOrderItem->sales_order_id = $salesOrder->id;
            $salesOrderItem->product_id = $product->id;
            $salesOrderItem->quantity = $productData['quantity'];
            $salesOrderItem->unit_price = $product->price;
            $salesOrderItem->save();
        }

        // Update the sales order with the total amount
        $salesOrder->total_amount = $totalAmount;
        $salesOrder->save();

        // Redirect to the sales orders page with a success message
        return redirect()->route('dashboard.business.order')->with('success', 'Sales order created successfully.');
    }






}
