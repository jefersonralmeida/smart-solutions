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
            $table->char('zip_code', 8);
            $table->string('street');
            $table->string('street_number');
            $table->string('district')->nullable();
            $table->string('address_details')->nullable();
            $table->string('city');
            $table->char('state', 2);
            $table->string('reference_point')->nullable();
            $table->string('phone')->nullable();
            $table->integer('clinic_id');
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
        Schema::dropIfExists('addresses');
    }
}
