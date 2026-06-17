<?php

namespace Database\Seeders;

use App\Models\SemesterGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SemesterGrade::factory(10)->create();
    }
}
