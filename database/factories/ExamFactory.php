<?php
namespace Database\Factories;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    protected $model = Exam::class;

    public function definition(): array
    {
        $ids = Subject::all()->pluck('id')->toArray();

        return [
            'subject_id' => fake()->randomElement($ids),
            'name' => fake()->sentence(1),
            'type' => $this->faker->randomElement(['écrit', 'Oral', 'Practical']),
            'coefficient' => $this->faker->randomFloat(1, 0.5, 3.0),
            'dateExam' => $this->faker->date(),
        ];
    }
}

