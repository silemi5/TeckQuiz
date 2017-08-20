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
            $table->increments('id'); //Class ID
            $table->integer('instructor_id'); //Instructor's ID at the 'users' table
            $table->integer('subject_id'); //Subject ID at the 'subjects' table
            $table->smallInteger('sem'); //semester, 1 is 1st, 2 is 2nd, 3rd is summer
            $table->smallInteger('yr_min'); //school year beginning
            $table->smallInteger('yr_max'); //school year end
            $table->timestamps();
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
