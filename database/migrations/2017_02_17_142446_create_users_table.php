<?php

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
        Schema::create('h_users', function (Blueprint $table) {
            $table->increments('u_id');
            $table->string('u_username');
            $table->string('u_password');
            $table->string('u_fname');
            $table->string('u_mname');
            $table->string('u_lname');
            $table->string('u_number');
            $table->tinyInteger('is_updated');
            $table->tinyInteger('is_admin');
            $table->tinyInteger('is_active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('h_users');
    }
}
