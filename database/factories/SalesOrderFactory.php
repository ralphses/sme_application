<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Customer;
use App\Models\PaymentMethodOption;
use App\Models\SalesOrder;
use App\Models\User;
use App\Utils\Utils;
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
            'payment_method_options_id' => PaymentMethodOption::factory(),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000), // random amount between 100 and 10000
            'status' => $this->faker->randomElement([Utils::ORDER_STATUS_PENDING, Utils::ORDER_STATUS_COMPLETED, Utils::ORDER_STATUS_CANCELLED]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
