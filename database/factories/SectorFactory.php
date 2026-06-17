<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Sector;
use App\Models\Teacher;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sector>
 */
class SectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        $ids = Department::all()->pluck('id')->toArray();

        static $usedNames = [];

        $availableNames = Teacher::where('StatusFil', 'true')
            ->distinct()
            ->pluck('name')
            ->diff($usedNames)
            ->toArray();

        if(empty($availableNames))
        {
            throw new Exception('No more unique names available');
        }

        $name = fake()->randomElement($availableNames);

        // Track used names
        $usedNames[] = $name;

        return [
            'name'        => fake()->sentence(2),
            'department_id' => fake()->randomElement($ids),
            'ChefFil'     => $name,
            'description' => fake()->sentence(10),
        ];
    }
}
