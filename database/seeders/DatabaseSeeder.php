<?php

namespace Database\Seeders;

use App\Models\CompagnieAerienne;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();
        //CompagnieAerienne::factory(3)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        CompagnieAerienne::factory()->create([
            'nom' => 'Test User',
            'pays' => 'test@example.com',
        ]);
    }
}
