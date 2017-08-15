<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_contacts', function (Blueprint $table) {
            $table->increments('c_id');
            $table->string('c_fname');
            $table->string('c_mname');
            $table->string('c_lname');
            $table->string('c_number');
            $table->string('c_agency')->nullable();
            $table->string('c_position')->nullable();
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('h_contacts');
    }
}
