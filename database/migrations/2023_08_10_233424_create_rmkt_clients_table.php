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
        Schema::create('rmkt_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('client_id');
            $table->foreignUuid('vet_id');
            $table->boolean('option_1')->nullable();
            $table->boolean('option_2')->nullable();
            $table->boolean('option_3')->nullable();
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
        Schema::dropIfExists('rmkt_clients');
    }
};
