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
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@easysme.com',
            'password' => Hash::make('password'),
            'role' => Utils::ROLE_ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@easysme.com',
            'password' => Hash::make('password'),
            'role' => Utils::ROLE_EMPLOYEE,
        ]);

        User::factory()->create([
            'name' => 'Business Owner',
            'email' => 'business_owner@easysme.com',
            'password' => Hash::make('password'),
            'role' => Utils::ROLE_BUSINESS_OWNER,
        ]);

        // Create users
        $users = User::factory()->count(6)->create();

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
                        SalesOrderItem::factory()->count(5)->create([
                            'sales_order_id' => $salesOrder->id,
                            'product_id' => $products->random()->id,
                        ]);
                    });

                    // Create a payment for each sales order
                    $salesOrders->each(function ($salesOrder) use ($business) {
                        Payment::factory()->create([
                            'sales_order_id' => $salesOrder->id,
                            'business_id' => $business->id,
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
