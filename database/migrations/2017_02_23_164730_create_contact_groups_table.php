<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_contact_groups', function (Blueprint $table) {
            $table->increments('cg_id');
            $table->integer('c_id')->unsigned();
            $table->foreign('c_id')->references('c_id')->on('h_contacts')->onUpdate('cascade');
            $table->integer('g_id')->unsigned();
            $table->foreign('g_id')->references('g_id')->on('h_groups')->onUpdate('cascade');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_contact_groups');
    }
}
