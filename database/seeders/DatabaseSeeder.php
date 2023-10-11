<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\stock;
use App\Models\User;
use App\Models\Vet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     "id" => 1,
        //     'name' => 'admin',
        //     'email' => 'admin',
        //     'password' => Hash::make('gto3000gt')
        // ]);
        // \App\Models\Vet::factory()->create();
        

        // $pwd = Hash::make('supertrio');
        // $csvFile = fopen(base_path("database/data/vet-Table.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $u = User::create([
        //             "id" => $data['1'],
        //             "name" => $data['3'],
        //             "email" => $data['1'],
        //             'email_verified_at' => now(),
        //             "password"=> Hash::make($data['1']),
        //             'remember_token' => 'generatedatafromvettable',
        //         ]);
        //         $u = Vet::create([
        //             "id" => $data['1'],
        //             "vet_name" => $data['3'],
        //             "vet_province" => $data['6'],
        //             "vet_city" => $data['5'],
        //             "vet_area" => $data['4'],
        //             "user_id" => $data['1'],
        //             "stock_id" => $data['2'],
        //         ]);
        //         // $s = stock::create([
        //         //     "id" => $data['2'],
        //         //     "total_stock" => $data['13'],
        //         //     "stock_adj" => 0,
        //         // ]);
        //         //print($u->id.$u->name);
        //     }
        //     $firstline = false;
        // }

        // fclose($csvFile);
    }
}
