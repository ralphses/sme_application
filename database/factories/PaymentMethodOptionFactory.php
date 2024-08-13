<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\PaymentMethodOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethodOption>
 */
class PaymentMethodOptionFactory extends Factory
{
    protected $model = PaymentMethodOption::class;

    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'method_name' => $this->faker->randomElement(['Credit Card', 'Cash', 'Bank Transfer', 'PayPal']),
            'details' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
