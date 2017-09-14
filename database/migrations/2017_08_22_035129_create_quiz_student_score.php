<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizStudentScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_student_score', function (Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->integer('quiz_event_id')->unsigned();
            $table->integer('score');
            $table->timestamp('recorded_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_student_score');
    }
}
