<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $Status = ['false', 'true'];


        $number = "0623960018";

        $localPath = '/storage/teacher_images/teacher.png';

        return [
            'name' => fake()->name,
            'email' => fake()->unique()->email,
            'password' => '12345678911',
            'dateNaissance' => fake()->date,
            'photo' => $localPath,
            'StatusDep' => $Status[array_rand($Status)],
            'StatusFil' => $Status[array_rand($Status)],
            'sellphone' => $number,
        ];
    }
}
