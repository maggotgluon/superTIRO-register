<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('client_code')->unique();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('phoneIsVerified');
            // optional field
            $table->string('pet_name')->nullable();
            $table->string('pet_breed')->nullable();
            $table->string('pet_weight')->nullable();
            $table->integer('pet_age_month')->nullable();
            $table->integer('pet_age_year')->nullable();

            $table->boolean('option_1')->nullable();
            $table->boolean('option_2')->nullable();
            $table->boolean('option_3')->nullable();
            // vet data -> point to vet data
            $table->string('vet_name');
            $table->foreignUuid('addr_id');

            // otp and codes and activated status
            $table->dateTime('active_date')->nullable();
            $table->string('active_status')->nullable();

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
        Schema::dropIfExists('clients');
    }
};
