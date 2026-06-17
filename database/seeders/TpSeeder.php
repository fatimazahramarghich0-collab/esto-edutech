<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tp;

class TpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Tp::factory()->count(10)->create();
    }
}
