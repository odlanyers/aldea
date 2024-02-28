<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'reyn',
            'email' => 'reynaldo.sanchez@outlook.com',
            // 'password' => '[contraseña_personalizada]',
        ]);

        $this->call([
            CategorySeeder::class,
        ]);
    }
}
