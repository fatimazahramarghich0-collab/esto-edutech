<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Exécuter le seeder pour peupler la table 'messages'.
     *
     * @return void
     */
    public function run(): void
    {

        Message::factory()->count(40)->create();
    }
}
