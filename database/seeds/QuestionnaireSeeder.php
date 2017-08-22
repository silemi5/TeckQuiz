<?php

use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questionnaires')->insert([[
            'questionnaire_id' => 1,
            'questionnaire_name' => 'Relationships'
        ],[
            'questionnaire_id' => 2,
            'questionnaire_name' => 'System Development Lifecycle'
        ]]);
    }
}
