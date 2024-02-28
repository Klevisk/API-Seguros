<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'super-admin',
            'description' => 'Super Admin Role',
        ]);

        // Crear Admin Role
        Role::create([
            'name' => 'admin',
            'description' => 'Administrator Role',
        ]);
    }
}
