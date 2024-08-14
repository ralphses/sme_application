<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(['role' => Utils::ROLE_EMPLOYEE]),
            "business_id" => Business::factory()
        ];
    }
}
