<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBulletinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_bulletins', function (Blueprint $table) {
            $table->increments('bl_id');
            $table->integer('bt_id')->unsigned();
            $table->foreign('bt_id')->references('bt_id')->on('h_bulletin_types')->onDelete('cascade');
            $table->text('bl_message');
            $table->enum('bl_type', ['Auto', 'Manual']);
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
        Schema::dropIfExists('h_bulletins');
    }
}
