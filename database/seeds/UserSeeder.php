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
        $userRole = Role::where('name', 'USUARIO')->first();

        $admin = User::create([
            'name' => 'Luigi Bros',
            'email' => 'luigi@email.com',
            'password' => Hash::make('123456'),
            'status' => true,
        ]);

        $user = User::create([
            'name' => 'Mario Bros',
            'email' => 'mario@email.com',
            'password' => Hash::make('123456'),
            'status' => true,
        ]);

        $admin->roles()->attach($adminRole);
        $admin->roles()->attach($userRole);
        $user->roles()->attach($userRole);
    }
}
