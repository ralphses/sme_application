<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'report_type' => $this->faker->randomElement(['sales', 'inventory', 'financial']),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
