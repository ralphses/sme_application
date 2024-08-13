<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Payment;
use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'sales_order_id' => SalesOrder::factory(),
            'amount' => $this->faker->randomFloat(2, 100, 10000), // random amount between 100 and 10000
            'payment_date' => $this->faker->date(),
            'payment_method' => $this->faker->randomElement(['credit card', 'cash', 'bank transfer']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
