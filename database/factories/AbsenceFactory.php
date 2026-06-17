<?php
namespace Database\Factories;

use App\Models\Absence;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbsenceFactory extends Factory
{
    /**
     * Le modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Absence::class;

    /**
     * Définition pour générer les données aléatoires.
     *
     * @return array
     */
    public function definition(): array
    {
        $ids = Subject::all()->pluck('id')->toArray();
        $ids2 = Student::all()->pluck('id')->toArray();
        return [
            'student_id' => $this->faker->randomElement($ids2),
            'subject_id' => $this->faker->randomElement($ids),
            'dateAbsence' => $this->faker->date(),
        ];
    }
}
