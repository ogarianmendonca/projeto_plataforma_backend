<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Entities\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Luigi Bros',
            'email' => 'luigi@email.com',
            'password' => Hash::make('123456'),
            'ativo' => true,
        ]);

        User::create([
            'name' => 'Mario Bros',
            'email' => 'mario@email.com',
            'password' => Hash::make('123456'),
            'ativo' => true,
        ]);
    }
}
