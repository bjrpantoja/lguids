<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_user_logs', function (Blueprint $table) {
            $table->increments('ul_id');
            $table->integer('u_id')->unsigned();
            $table->foreign('u_id')->references('u_id')->on('h_users')->onDelete('cascade');
            $table->string('ul_logs');
            $table->datetime('ul_login_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_user_logs');
    }
}
