<?php

use Illuminate\Database\Seeder;

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
        DB::table('users')->insert([
            [
                'usr_id' => 2,
                'usr' => 'JoEM',
                'password' => '$2y$10$Lk/DDdqtE5Pc5mtuO7dumuwQSWb2I8JqCKsfVAFIpC5w0NokYX3Tm',
                'permissions' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],[
                'usr_id' => 3,
                'usr' => 'OnrubiaFA',
                'password' => '$2y$10$Lk/DDdqtE5Pc5mtuO7dumuwQSWb2I8JqCKsfVAFIpC5w0NokYX3Tm',
                'permissions' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],[
                'usr_id' => 4,
                'usr' => 'PequitKA',
                'password' => '$2y$10$Lk/DDdqtE5Pc5mtuO7dumuwQSWb2I8JqCKsfVAFIpC5w0NokYX3Tm',
                'permissions' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ],[
                'usr_id' => 5,
                'usr' => 'ReyesCP',
                'password' => '$2y$10$Lk/DDdqtE5Pc5mtuO7dumuwQSWb2I8JqCKsfVAFIpC5w0NokYX3Tm',
                'permissions' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now() 
            ]
        ]);
    }
}
