<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\ExamGrade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExamGrade>
 */
class ExamGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ids = Exam::all()->pluck('id')->toArray();
        $ids2 = Student::all()->pluck('id')->toArray();
        return [
            'note' => fake()->randomFloat(2, 12, 20),
            'exam_id' => fake()->randomElement($ids),
            'student_id' => fake()->randomElement($ids2),
        ];
    }
}
