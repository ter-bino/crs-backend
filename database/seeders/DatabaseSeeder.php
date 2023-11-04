<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\College;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        College::factory()->count(20)->create();
    }
}
