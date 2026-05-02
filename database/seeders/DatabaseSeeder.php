<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AjusteSeeder::class,
            SucursalSeeder::class,
            EmpleadoSeeder::class,
            CategoriaSeeder::class,
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Freddy Hilari', 'password' => bcrypt('12345678')]
        );

        $superAdminRole = Role::query()->firstOrCreate([
            'name' => 'SUPER ADMIN',
            'guard_name' => 'web',
        ]);

        $admin->syncRoles([$superAdminRole->name]);

        Sucursal::query()->firstOrCreate(
            ['nombre' => 'CASA MATRIZ'],
            [
                'direccion' => 'Av. Principal 123 - Centro',
                'telefono' => '987654321',
                'estado' => true,
            ]
        );
    }
}
