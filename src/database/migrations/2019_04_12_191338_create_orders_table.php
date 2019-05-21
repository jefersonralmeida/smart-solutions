<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product');
            $table->integer('patient_id');
            $table->integer('dentist_id');
            $table->json('address_id')->nullable();
            $table->json('data');
            $table->integer('status')->default(1);
            $table->json('status_history')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_document')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_zip_code')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('shipping')->nullable();
            $table->string('payment')->nullable();
            $table->integer('integration_id')->nullable();
            $table->boolean('integration_failed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
