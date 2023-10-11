<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Vet;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/vets',function(Request $request){
    return Vet::all();
    return DB::table('vets')->select('id','vet_name','vet_province')
        ->orderBy('vet_name')
        ->when(
            $request->search,
            fn (Builder $query) => $query
                ->where('vet_name', 'like', "%{$request->search}%")
        )->get();

    // foreach (DB::table('vets')->get() as $index => $vet) {
    //     $vet_list[$index]['id']=$vet->id;
    //     $vet_list[$index]['name']=$vet->vet_name;
    //     $vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
    // }
    // return $vet_list;php
})->name('vets');
