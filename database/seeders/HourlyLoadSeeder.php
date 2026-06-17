<?php

namespace Database\Seeders;

use App\Models\HourlyLoad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HourlyLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HourlyLoad::factory(10)->create();
    }
}
