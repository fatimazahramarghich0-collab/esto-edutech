<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Teacher;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */

    public function definition(): array
    {
        static $usedNames = [];

        $availableNames = Teacher::where('StatusDep', 'true')
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
            'name' => fake()->sentence(2),
            'chefDep' => $name,
        ];
    }
}
