<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Database\Factories\CourseFactory;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Utiliser la factory pour créer et sauvegarder 10 instances de Course
        Course::factory()->count(10)->create();
    }
}
