<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('usr_id');
            $table->string('usr')->unique();
            $table->string('password');
            $table->integer('permissions');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'usr_id' => 0,
                'usr' => 'Administrator',
                'password' => '$2y$10$Lk/DDdqtE5Pc5mtuO7dumuwQSWb2I8JqCKsfVAFIpC5w0NokYX3Tm',
                'permissions' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
