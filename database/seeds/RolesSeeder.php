<?php

use Illuminate\Database\Seeder;
use App\Entities\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
            'name' => 'ADMINISTRADOR',
            'status' => true
        ]);

        Role::create([
            'name' => 'COORDENADOR',
            'status' => true
        ]);

        Role::create([
            'name' => 'USUARIO',
            'status' => true
        ]);

        Role::create([
            'name' => 'CLIENTE',
            'status' => true
        ]);
    }
}
