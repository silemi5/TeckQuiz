<?php

use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->insert([[
            'usr_id' => 2,
            'given_name' => 'Emir',
            'family_name' => 'Jo',
            'middle_name' => 'M.',
            'ext_name' => 'Jr.',
        ],[
            'usr_id' => 3,
            'given_name' => 'Fatima Mercy',
            'family_name' => 'Onrubia',
            'middle_name' => 'A.',
            'ext_name' => '',
        ],[
            'usr_id' => 4,
            'given_name' => 'Christian',
            'family_name' => 'Reyes',
            'middle_name' => 'P.',
            'ext_name' => '',
        ],[
            'usr_id' => 5,
            'given_name' => 'Keren Keziah',
            'family_name' => 'Pequit',
            'middle_name' => 'A.',
            'ext_name' => '',
        ]]);
    }
}
