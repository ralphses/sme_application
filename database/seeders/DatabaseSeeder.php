<?php

namespace Database\Seeders;

use App\Utils\Utils;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Business;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\Inventory;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Report;
use App\Models\PaymentMethodOption;
use App\Models\RecentActivity;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        $users = User::factory()->count(10)->create();

        // Create recent activities for users
        RecentActivity::factory()->count(50)->create([
            'user_id' => $users->random()->id
        ]);

        // Create businesses for each user
        $users->each(function ($user) {
            $businesses = Business::factory()->count(3)->create(['user_id' => $user->id]);

            $businesses->each(function ($business) {
                // Create products for each business
                $products = Product::factory()->count(10)->create(['business_id' => $business->id]);

                // Create customers for each business
                $customers = Customer::factory()->count(5)->create(['business_id' => $business->id, 'user_id' => $business->user_id]);

                // Create sales orders for each customer
                $customers->each(function ($customer) use ($business, $products) {
                    $salesOrders = SalesOrder::factory()->count(3)->create([
                        'business_id' => $business->id,
                        'user_id' => $customer->user_id,
                        'customer_id' => $customer->id,
                    ]);

                    // Create sales order items for each sales order
                    $salesOrders->each(function ($salesOrder) use ($products) {
                        $items = SalesOrderItem::factory()->count(5)->create([
                            'sales_order_id' => $salesOrder->id,
                            'product_id' => $products->random()->id,
                        ]);

                        // Calculate the total amount from sales order items
                        $totalAmount = $items->sum('price');

                        // Create a payment for each sales order with the total amount
                        Payment::factory()->create([
                            'sales_order_id' => $salesOrder->id,
                            'business_id' => $salesOrder->business_id,
                            'amount' => $totalAmount,
                        ]);
                    });
                });

                // Create inventory records for each product
                $products->each(function ($product) use ($business) {
                    Inventory::factory()->count(3)->create([
                        'business_id' => $business->id,
                        'product_id' => $product->id,
                    ]);
                });

                // Create expenses for each business
                Expense::factory()->count(5)->create(['business_id' => $business->id]);

                // Create payment method options for each business
                PaymentMethodOption::factory()->count(3)->create(['business_id' => $business->id]);

                // Create reports for each business
                Report::factory()->count(2)->create(['business_id' => $business->id]);
            });
        });
    }
}
