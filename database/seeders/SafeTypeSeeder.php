<?php

namespace Database\Seeders;

use App\Models\Safe_type;
use Illuminate\Database\Seeder;

class SafeTypeSeeder extends Seeder
{

    public function run()
    {
        Safe_type::create([
            'name' => 'Familiar',
            'type' => 'Family',
            'price'=> '15',
        ]);

        Safe_type::create([
            'name' => 'Poliza de Vehiculos',
            'type' => 'Vehicle',
            'price'=> '15',
        ]);
    }
}
