<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use Database\Factories\ExamFactory;

class ExamSeeder extends Seeder
{
    public function run(): void
    {

        Exam::factory()->count(20)->create();
    }
}
