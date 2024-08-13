<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Revenue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Revenue>
 */
class RevenueFactory extends Factory
{
    protected $model = Revenue::class;

    public function definition()
    {
        return [
            'business_id' => Business::inRandomOrder()->first()->id, // Random business
            'amount' => $this->faker->numberBetween(5000, 100000), // Random revenue amount
            'created_at' => $this->faker->dateTimeThisYear(), // Random date this year
            'updated_at' => $this->faker->dateTimeThisYear(), // Random date this year
        ];
    }
}
