<?php

namespace Database\Factories;

use App\Models\Sector;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDigits = fake()->randomNumber(8);

        $ids = Sector::all()->pluck('id')->toArray();

        $number = "06" . $randomDigits;

        $localPath = '/storage/student_images/student.png';


        return [
            'name' => fake()->name,
            'sector_id' => fake()->randomElement($ids),
            'email' => fake()->email,
            'password' => '12345678910',
            'dateNaissance' => fake()->date,
            'CodeMassar' => (string) fake()->unique()->numberBetween(10000, 99999),
            'codeApogee' => (string) fake()->unique()->numberBetween(10000, 99999),
            'sellphone' => $number,
            'noteDiplome' => fake()->randomFloat(2, 0, 20),
            'photo' => $localPath,

        ];
    }
}
