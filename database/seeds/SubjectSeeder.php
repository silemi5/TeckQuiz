<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([[
            'subject_id' => 1,
            'subject_code' => 'CSIT 000',
            'subject_desc' => 'Database Management Systems 2'
        ],[
            'subject_id' => 2,
            'subject_code' => 'CSIT 133',
            'subject_desc' => 'System Analysis and Design'
        ]]);
    }
}
