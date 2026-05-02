<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Medicamentos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Suplementos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Higiene', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vitaminas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Dermocosmética', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Bebés', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Antigripales', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Digestivos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cardiovasculares', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Naturales', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}