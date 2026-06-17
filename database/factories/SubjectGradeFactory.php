<?php
namespace Database\Factories;

use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectGrade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubjectGrade>
 */
class SubjectGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ids = Subject::all()->pluck('id')->toArray();
        $ids2 = Student::all()->pluck('id')->toArray();
        return [
            'note' => fake()->randomFloat(2,12, 20),
            'subject_id' => fake()->randomElement($ids),
            'student_id' => fake()->randomElement($ids2),
        ];
    }
}
