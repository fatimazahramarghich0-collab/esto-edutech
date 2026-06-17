<?php
namespace Database\Factories;

use App\Models\Course;
use App\Models\Td;
use Illuminate\Database\Eloquent\Factories\Factory;

class TdFactory extends Factory
{
    protected $model = Td::class;

    public function definition(): array
    {
        $ids = Course::all()->pluck('id')->toArray();

        return [
            'name' => $this->faker->sentence,
            'course_id' => fake()->randomElement($ids),
            'fichier' => '/storage/default/default.pdf',
        ];
    }
}

