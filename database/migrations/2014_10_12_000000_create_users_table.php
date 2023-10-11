<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id',30)->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        //seed data
        // $pwd = Hash::make('supertrio');
        // $csvFile = fopen(base_path("database/data/trioUser.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $u = User::create([
        //             "id" => $data['0'],
        //             "name" => $data['4'],
        //             "email" => $data['3'],
        //             'email_verified_at' => now(),
        //             "password"=> $pwd, // password
        //             'remember_token' => Str::random(10),
        //         ]);
        //         //print($u->id.$u->name);
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
        Schema::dropIfExists('users');
    }
};
