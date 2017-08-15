<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_settings', function (Blueprint $table) {
            $table->increments('st_id');
            $table->string('st_name');
            $table->string('st_alias');
            $table->string('st_footer');
            $table->text('st_about');
            $table->string('st_globe');
            $table->string('st_smart');
            $table->string('st_facebook');
            $table->string('st_twitter');
            $table->string('st_google');
            $table->string('st_address');
            $table->string('st_extra');
            $table->string('st_earthquake');
            $table->string('st_weather');
            $table->string('st_volcano');
            $table->string('st_cyclone');
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
        Schema::dropIfExists('h_settings');
    }
}
