<?php

use App\Models\User;
use App\Models\Vet;
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
        Schema::create('vets', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('vet_name');
            $table->string('vet_province');
            $table->string('vet_city');
            $table->string('vet_area');
            $table->text('vet_remark')->nullable();
            $table->foreignUuid('user_id')->nullable();
            $table->foreignUuid('stock_id')->nullable();
            $table->timestamps();
        });
        
        //seed data
        // $csvFile = fopen(base_path("database/data/trioUser.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $u = User::where('email',$data['3'])->first();
        //         // dd($u->id);
        //         $v = Vet::create([
        //             "id" => $data['3'],
        //             "vet_name"=>$data['4'],
        //             "vet_area" => $data['5'],
        //             "vet_city" => $data['6'],
        //             "vet_province" => $data['7'],
        //             "user_id"=>$u->id,
        //         ]);
        //         // print($v->vet_name.$v->user_id );
        //     }
        //     $firstline = false;
        // }

        // fclose($csvFile);
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vets');
    }
};
