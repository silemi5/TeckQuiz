<?php

use Illuminate\Database\Seeder;

use App\StudentClass;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentClass::create([
            'student_id' => 3,
            'class_id' => "4KMMR"
        ]);

    //     DB::table('student_classes')->insert([[
    //             'class_id' => "4KMMR",
    //             'student_id' => 3
    //         ],[
    //             'class_id' => "4KMMR",
    //             'student_id' => 4
    //         ],[
    //             'class_id' => "4KMMR",
    //             'student_id' => 5
    //         ],[
    //             'class_id' => "3KMMR",
    //             'student_id' => 3
    //         ],[
    //             'class_id' => "3KMMR",
    //             'student_id' => 4
    //         ],[
    //             'class_id' => "3KMMR",
    //             'student_id' => 5
    //         ]
    // ]);
    }
}
