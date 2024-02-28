<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Servicios', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Entretenimiento', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alimentacion', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ropa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cuidado personal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Regalos', 'created_at' => now(), 'updated_at' => now()],
        ];

        Category::insert($categories);
    }
}
