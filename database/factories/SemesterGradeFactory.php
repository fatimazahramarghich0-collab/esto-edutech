<?php

namespace Database\Factories;

use App\Models\Semester;
use App\Models\SemesterGrade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SemesterGrade>
 */
class SemesterGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ids = Semester::all()->pluck('id')->toArray();
        $ids2 = Student::all()->pluck('id')->toArray();
        return [
            'note' => fake()->randomFloat(2 , 0, 20),
            'semester_id' => fake()->randomElement($ids),
            'student_id' => fake()->randomElement($ids2),
        ];
    }
}
