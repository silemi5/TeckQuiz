<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_events', function (Blueprint $table) {
            $table->increments('id'); //quiz event id
            $table->integer('quiz_event_name');
            $table->integer('questionnaire_id'); //questionnaire to use
            $table->integer('class_id'); //class id
            $table->timestamp('quiz_created');
            $table->timestampTz('quiz_conducted');
            $table->timestampTz('is_quiz_finished');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_events');
    }
}
