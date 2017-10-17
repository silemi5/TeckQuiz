<?php

use Illuminate\Database\Seeder;

use App\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Initialize Users
        User::create([
            'usr' => 'silemi5',
            'permissions' => 1,
            'password' => Hash::make("password"),
        ]);
        User::create([
            'usr' => 'student',
            'permissions' => 0,
            'password' => Hash::make("password"),
        ]);
    }
}
