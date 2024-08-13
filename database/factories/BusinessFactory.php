<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    protected $model = Business::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'address' => $this->faker->address,
            'status' => $this->faker->randomElement([Utils::BUSINESS_STATUS_ACTIVE, Utils::BUSINESS_STATUS_INACTIVE]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
