<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDentistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dentists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('cpf')->nullable();
            $table->string('cro');
            $table->char('cro_status')->default('W'); // Waiting, Approved, Reproved, Error
            $table->string('cro_status_message')->nullable();
            $table->timestamp('cro_dispatched_at')->default(now());
            $table->timestamp('cro_approved_at')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->integer('clinic_id')->nullable();
            $table->char('integration_status')->default('P'); // Processing, Failed, Success
            $table->string('integration_id')->nullable();
            $table->string('integration_message')->nullable();
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
        Schema::dropIfExists('dentists');
    }
}
