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
        // Schema::create('vet_infos', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignUuid('vet_id');
        //     $table->string('meta_name');
        //     $table->string('meta_type');
        //     $table->string('meta_value');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vet_infos');
    }
};
