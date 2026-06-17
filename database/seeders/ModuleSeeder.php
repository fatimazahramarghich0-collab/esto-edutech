<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use Database\Factories\ModuleFactory;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        // Utiliser la factory pour créer et sauvegarder 10 instances de Module
        Module::factory()->count(10)->create();
    }
}

