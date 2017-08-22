<?php

use Illuminate\Database\Seeder;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_classes')->insert([[
            'class_id' => 1,
            'student_id' => 2
        ],[
            'class_id' => 2,
            'student_id' => 2
        ]]);
    }
}
