<?php
namespace Database\Factories;

use App\Models\Sector;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

class SemesterFactory extends Factory
{
    /**
     * Le modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Semester::class;

    /**
     * Définition pour générer les données aléatoires.
     *
     * @return array
     */
    public function definition(): array
    {
        // Predefined semester names
        $semesterNames = ['S1', 'S2', 'S3', 'S4'];

        // Get all sector ids
        $ids = Sector::all()->pluck('id')->toArray();

        return [
            'semesterName' => $this->faker->randomElement($semesterNames),
            'sector_id' => $this->faker->randomElement($ids),
        ];
    }
}
