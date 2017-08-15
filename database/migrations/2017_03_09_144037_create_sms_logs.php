<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_sms_logs', function (Blueprint $table) {
            $table->increments('sl_id');
            $table->string('sl_number');
            $table->text('sl_message');
            $table->enum('sl_status', ['SENT', 'RECEIVED', 'FAILED', 'QUEUED']);
            $table->tinyInteger('is_read')->default(0);
            $table->string('sl_timestamp');
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
        Schema::dropIfExists('h_sms_logs');
    }
}
