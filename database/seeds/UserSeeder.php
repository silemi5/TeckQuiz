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
                'usr_id' => 1,
                'usr' => 'Teacher',
                'password' => '$2y$10$Lk/DDdqtE5Pc5mtuO7dumuwQSWb2I8JqCKsfVAFIpC5w0NokYX3Tm',
                'permissions' => 1,
                'created_at' => '2017-08-21 00:00:00',
                'updated_at' => '2017-08-21 00:00:01'
            ],[
                'usr_id' => 2,
                'usr' => 'Student',
                'password' => '$2y$10$Lk/DDdqtE5Pc5mtuO7dumuwQSWb2I8JqCKsfVAFIpC5w0NokYX3Tm',
                'permissions' => 0,
                'created_at' => '2017-08-21 00:00:00',
                'updated_at' => '2017-08-21 00:00:01' 
        ]]);
    }
}
