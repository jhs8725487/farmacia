<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laboratorios')->insert([
            [
                'nombre' => 'Laboratorio Alfa',
                'direccion' => 'Calle 1 #123',
                'telefono' => '123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laboratorio Beta',
                'direccion' => 'Calle 2 #456',
                'telefono' => '987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laboratorio Gamma',
                'direccion' => 'Calle 3 #789',
                'telefono' => '555555555',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
