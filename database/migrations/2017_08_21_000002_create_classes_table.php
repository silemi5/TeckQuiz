<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('class_id');
            $table->string('course_sec');
            $table->integer('instructor_id')->unsigned();   //instructor_id comes from users table
            $table->integer('subject_id')->unsigned();
            $table->boolean('class_active');
        });
        Schema::table('classes', function(Blueprint $table){
            $table->foreign('instructor_id')->references('usr_id')->on('users');
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
