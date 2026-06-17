<?php
namespace Database\Factories;

use App\Models\Module;
use App\Models\ModuleGrade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleGradeFactory extends Factory
{
    protected $model = ModuleGrade::class;

    public function definition(): array
    {
        $ids = Module::all()->pluck('id')->toArray();
        $ids2 = Student::all()->pluck('id')->toArray();
        return [
            'noteModule' => $this->faker->randomFloat(2, 0, 20),
            'module_id' => fake()->randomElement($ids),
            'student_id' => fake()->randomElement($ids2),
        ];
    }
}
