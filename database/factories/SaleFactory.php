<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'business_id' => Business::inRandomOrder()->first()->id, // Random business
            'amount' => $this->faker->numberBetween(1000, 50000), // Random amount
            'created_at' => $this->faker->dateTimeThisYear(), // Random date this year
            'updated_at' => $this->faker->dateTimeThisYear(), // Random date this year
        ];
    }
}
