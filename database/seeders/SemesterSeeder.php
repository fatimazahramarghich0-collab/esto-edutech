<?php
namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Exécuter le seeder pour peupler la table 'semesters'.
     *
     * @return void
     */
    public function run(): void
    {
        $numSectors = Sector::count();

        $numSectors = $numSectors * 4;

        Semester::factory()->count($numSectors)->create();
    }
}
