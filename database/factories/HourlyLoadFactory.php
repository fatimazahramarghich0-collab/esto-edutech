<?php

namespace Database\Factories;

use App\Models\HourlyLoad;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HourlyLoad>
 */
class HourlyLoadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ids = Teacher::all()->pluck('id')->toArray();
        return [
            'charge' => fake()->randomFloat(2, 12, 40),
            'teacher_id' => fake()->randomElement($ids),
        ];
    }
}
