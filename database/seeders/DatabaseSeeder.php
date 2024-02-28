<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([RolesSeeder::class,]);
        $this->call([ UsersAndRolesSeeder::class,]);
        // $this->call([ SafeTypeSeeder::class,]);
    }

}
