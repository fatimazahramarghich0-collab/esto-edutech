<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //call to the Teacher seeder
        $this->call(TeacherSeeder::class);

        // Call to the admin seeder
        $this->call(AdminSeeder::class);

        //call to department seeder
        $this->call(DepartmentSeeder::class);

        //call to sector seeder
        $this->call(SectorSeeder::class);

        // Call to the student seeder
        $this->call(StudentSeeder::class);

        // Call to the semester seeder
        $this->call(SemesterSeeder::class);

         //call to SemestreGrade seeder
        $this->call(SemesterGradeSeeder::class);

        // Call to the module seeder
        $this->call(ModuleSeeder::class);

        // Call to the module_grade seeder
        $this->call(ModuleGradeSeeder::class);



       //call to Subject seeder
        $this->call(SubjectSeeder::class);

        //call to SubjectGrade seeder
        $this->call(SubjectGradeSeeder::class);

        // Call to the course seeder
        $this->call(CourseSeeder::class);

        // Call to the exam seeder
        $this->call(ExamSeeder::class);

        // Call to the exam_grade seeder
        $this->call(ExamGradeSeeder::class);

        // Call to the tds seeder
        $this->call(TdSeeder::class);

        // Call to the tps seeder
        $this->call(TpSeeder::class);

        //call to HourlyLoad seeder
        $this->call(HourlyLoadSeeder::class);

        // Call to the absence seeder
        $this->call(AbsenceSeeder::class);

        // Call to the message seeder
        $this->call(MessageSeeder::class);

    }
}
