<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function(Blueprint $table){
            $table->foreign('instructor_id')->references('usr_id')->on('users');
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
        });
        Schema::table('student_classes', function(Blueprint $table){
            $table->foreign('student_id')->references('usr_id')->on('users');
            $table->foreign('class_id')->references('class_id')->on('classes');
        });
        Schema::table('quiz_events', function(Blueprint $table){
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->foreign('questionnaire_id')->references('questionnaire_id')->on('questionnaires');
        });
        Schema::table('questions', function(Blueprint $table){
            $table->foreign('questionnaire_id')->references('questionnaire_id')->on('questionnaires');
        });
        Schema::table('user_profiles', function(Blueprint $table){
            $table->foreign('usr_id')->references('usr_id')->on('users');
        });
        Schema::table('quiz_student_score', function(Blueprint $table){
            $table->foreign('student_id')->references('usr_id')->on('users');
            $table->foreign('quiz_event_id')->references('quiz_event_id')->on('quiz_events');
        });    
        Schema::table('quiz_student_answers', function(Blueprint $table){
            $table->foreign('student_id')->references('usr_id')->on('users');
            $table->foreign('quiz_event_id')->references('quiz_event_id')->on('quiz_events');
            $table->foreign('question_id')->references('question_id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
