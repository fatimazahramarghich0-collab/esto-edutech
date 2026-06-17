<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ids = Teacher::all()->pluck('id')->toArray();

        $ids2 = Module::all()->pluck('id')->toArray();

        return [
            'name' => fake()->sentence(1),
            'teacher_id' => fake()->randomElement($ids),
            'module_id' => fake()->randomElement($ids2),
            'coefficient' => fake()->randomFloat(2,1,2),
            'photo' => fake()->image(),
            'nb_cm' => fake()->randomNumber( 2),
            'nb_tp' => fake()->randomNumber( 2),
            'nb_td' => fake()->randomNumber( 2),
        ];
    }
}
