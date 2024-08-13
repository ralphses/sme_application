<?php

namespace Database\Factories;

use App\Models\RecentActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecentActivityFactory extends Factory
{
    protected $model = RecentActivity::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'activity_type' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
