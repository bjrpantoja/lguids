<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBulletinRecipients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_bulletin_recipients', function (Blueprint $table) {
            $table->increments('blr_id');
            $table->integer('bl_id')->unsigned();
            $table->foreign('bl_id')->references('bl_id')->on('h_bulletins');
            $table->integer('c_id')->unsigned();
            $table->foreign('c_id')->references('c_id')->on('h_contacts');
            $table->enum('blr_status', ['SENT', 'FAILED']);
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
        Schema::dropIfExists('h_bulletin_recipients');
    }
}
