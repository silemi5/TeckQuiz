<?php

use Illuminate\Database\Seeder;

class QuizEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_events')->insert([[
            'quiz_event_id' => 1,
            'quiz_event_name' => 'Relationships',
            'questionnaire_id' => 1,
            'quiz_event_status' => 1,//enabled quiz
            'class_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],[
            'quiz_event_id' => 2,
            'quiz_event_name' => 'System Development Lifecycle',
            'questionnaire_id' => 2,
            'quiz_event_status' => 0,//disabled quiz
            'class_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);
    }
}
