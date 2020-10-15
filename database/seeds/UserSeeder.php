<?php

use App\Entities\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Entities\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'ADMINISTRADOR')->first();
        $coordenadorRole = Role::where('name', 'COORDENADOR')->first();
        $userRole = Role::where('name', 'USUARIO')->first();
        $clienteRole = Role::where('name', 'CLIENTE')->first();

        $admin = User::create([
            'name' => 'Luigi Bros',
            'email' => 'luigi@email.com',
            'password' => Hash::make('123456'),
            'status' => true,
            'image' => 'sem_imagem',
        ]);

        $user = User::create([
            'name' => 'Mario Bros',
            'email' => 'mario@email.com',
            'password' => Hash::make('123456'),
            'status' => true,
            'image' => 'sem_imagem',
        ]);

        $admin->roles()->attach($adminRole);
        $admin->roles()->attach($coordenadorRole);
        $admin->roles()->attach($userRole);
        $admin->roles()->attach($clienteRole);

        $user->roles()->attach($userRole);
        $user->roles()->attach($clienteRole);
    }
}
