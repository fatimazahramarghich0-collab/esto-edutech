<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModuleGrade;

class ModuleGradeSeeder extends Seeder
{
    public function run(): void
    {
        // Utiliser la factory pour créer et sauvegarder des instances de ModuleGrade
        ModuleGrade::factory()->count(10)->create();
    }
}
