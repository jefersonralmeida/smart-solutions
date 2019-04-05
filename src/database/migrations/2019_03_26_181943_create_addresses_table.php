<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification');
            $table->string('receiver_name');
            $table->string('street_address_1');
            $table->string('street_address_2');
            $table->string('reference_point');
            $table->string('phone');
            $table->integer('clinic_id');
            $table->timestamps();
            $table->unique('clinic_id', 'identification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
