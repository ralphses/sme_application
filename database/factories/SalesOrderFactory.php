<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Customer;
use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    protected $model = SalesOrder::class;

    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'user_id' => User::factory(),
            'customer_id' => Customer::factory(),
            'order_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000), // random amount between 100 and 10000
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
