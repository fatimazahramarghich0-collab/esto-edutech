<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Td;

class TdSeeder extends Seeder
{
    public function run(): void
    {
        Td::factory()->count(10)->create();
    }
}
