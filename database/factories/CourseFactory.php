<?php
namespace Database\Factories;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $ids = Subject::all()->pluck('id')->toArray();
        return [
            'name' => $this->faker->sentence(2),
            'subject_id' => fake()->randomElement($ids),
            'fichier' => '/storage/default/default.pdf',
        ];
    }
}

