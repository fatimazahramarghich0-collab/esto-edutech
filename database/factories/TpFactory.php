<?php
namespace Database\Factories;

use App\Models\Course;
use App\Models\Tp;
use Illuminate\Database\Eloquent\Factories\Factory;

class TpFactory extends Factory
{
    protected $model = Tp::class;

    public function definition(): array
    {
        $ids = Course::all()->pluck('id')->toArray();
        return [
            'name' => $this->faker->sentence,
            'course_id' => $this->faker->randomElement($ids),
            'fichier' => '/storage/default/default.pdf',
        ];
    }
}

