<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([[
            'question_id' => 1,
            'questionnaire_id' => 1,
            'question_name' => 'What is 1 + 1?',
            'question_type' => 2,
            'choices' => '2;11;Both the indicated numbers;Not listed',
            'answer' => 3,
            'points' => 1
        ],[
            'question_id' => 2,
            'questionnaire_id' => 1,
            'question_name' => 'Do you love her?',
            'question_type' => 3,
            'choices' => '',
            'answer' => 0,
            'points' => 1
        ],[
            'question_id' => 3,
            'questionnaire_id' => 1,
            'question_name' => 'What is love?',
            'question_type' => 1,
            'choices' => '',
            'answer' => 'Love is what?',
            'points' => 1
        ],[
            'question_id' => 4,
            'questionnaire_id' => 2,
            'question_name' => 'What is SDLC?',
            'question_type' => 2,
            'choices' => 'System Danger Life Cycle;Subject Defined Life Cycle;System Defined Life Cycle;System Development Lifecycle',
            'answer' => 4,
            'points' => 1
        ],[
            'question_id' => 5,
            'questionnaire_id' => 2,
            'question_name' => 'IT is to Computers as CE is to ?',
            'question_type' => 2,
            'choices' => 'Ruler;Layout;Square;Building',
            'answer' => 4,
            'points' => 1
        ],[
            'question_id' => 6,
            'questionnaire_id' => 2,
            'question_name' => 'Is it true?',
            'question_type' => 3,
            'choices' => '',
            'answer' => 1,
            'points' => 10
        ]
        ]);
    }
}
