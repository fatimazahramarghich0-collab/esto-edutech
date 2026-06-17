<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absence;

class AbsenceSeeder extends Seeder
{
    /**
     * Exécuter le seeder pour peupler la table 'absences'.
     *
     * @return void
     */
    public function run(): void
    {

        Absence::factory()->count(10)->create();
    }
}
