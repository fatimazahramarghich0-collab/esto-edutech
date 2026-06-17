<?php
    namespace Database\Factories;

    use App\Models\Module;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

    $path = '/storage/modules_photos/book.png/';

    class ModuleFactory extends Factory
    {
        protected $model = Module::class;



        public function definition(): array
        {
            $ids = Semester::all()->pluck('id')->toArray();
            return [
                'name' => $this->faker->word,
                'semester_id' => fake()->randomElement($ids),
                'photo' => $path = '/storage/modules_photos/book.png',
            ];
        }
    }

