<?php

use App\Http\Livewire\Admin\RegisterDash;
use App\Models\Client;
use App\Models\ClientInfo;
use App\Models\User;
use App\Models\Vet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\VetDashboard;
use App\Http\Livewire\VetDashboardV2;
use App\Http\Livewire\Admin\DashboardV2;
use App\Http\Livewire\Admin\Vet as vetSingle;
use App\Http\Livewire\Admin\Vets as vetall;

use App\Http\Livewire\Rmkt\Index as rmkt;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $date = Carbon::create('21 Aug 2025');
    if(now()>=$date){
        return view('under');
    }
    return view('client.register');
    // return view('welcome');
})->name('index');

Route::get('/admin', function () {
    return view('welcome');
})->name('admin');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::name('client.')->prefix('client')->group(function (){
    Route::get('/', function () {
        $date = Carbon::create('21 Aug 2025');
        if(now()>=$date){
            return view('under');
        }
        return view('client.register');
    } )->name('index');

    Route::get('/login', function () {
        $date = Carbon::create('21 Aug 2025');
        if(now()>=$date){
            return view('under');
        }
        return view('client.login');
    } )->name('login');

    Route::get('/register', function () {
        
        $date = Carbon::create('21 Aug 2025');
        if(now()>=$date){
            return view('under');
        }
        return view('client.register');
    } )->name('register');
    
    Route::get('/email/{id?}', function ($id=null) {
        return view('mails.email',['phone'=>'0809166690','pet_name'=>'มอมแมม','vet_name'=>'โรงพยาบาลสัตว์สักที่']);
    } )->name('email');
    
    Route::get('/delete/{id?}', function ($id=null) {
        if($id==='all'){
            DB::table('clients')->delete();
            return view('welcome');
        }else if($id){
            DB::table('clients')->where('phone', $id)->delete();
            return view('welcome');
        }
        return redirect(route('index')) ;
    } )->name('delete');
    

    Route::get('/ticket/{phone}', function ($phone) {

        $date = Carbon::create('21 Aug 2025');
        if(now()>=$date){
            return view('under');
        }
        return view('client.dashboard',['phone'=>$phone]);
    } )->name('ticket');
});
Route::name('rmkt.')->prefix('rmkt')->group(function (){
    // case no scan
    Route::get('/', rmkt::class )->name('index');
    //link from rmkt include client id or phone
    Route::get('/id/{phone}',rmkt::class )->name('landing');

});
Route::name('admin.')->prefix('admin')->group(function (){
    Route::get('/dashboard', RegisterDash::class )->name('registerDash');

    /* Route::get('/dashboard', DashboardV2::class )->name('dashboard');
    
    Route::get('/vet', vetall::class)->name('vets');

    Route::get('/vet/{vet_id}', vetSingle::class)->name('vetSingle'); */

});

Route::name('vet.')->prefix('vet')->group(function (){
    Route::get('/', function () {
        dd('vet');
    } )->name('index');

    Route::get('/login', function () {
        return view('vet.login');
    } )->name('login');

    Route::get('/register', function () {
        return view('vet.register');
    } )->name('register');

    // Route::get('/dashboard/{id}', VetDashboard::class )->name('ticket');

    Route::get('/dashboard/{vet_id}', VetDashboardV2::class )->name('ticketV2');
});

Route::get('/download',function(){
    $now = Carbon::now()->toDateTimeString();
    // dd($now);
    $fileName = 'client '.$now.'.csv';
    $Clients = Client::all();
    
    $headers = array(
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    $columns = array('code', 'name', 'email', 'phone', 'status', 'activate date','vet id', 'vet name' ,'Pet name', 'Pet bread', 'Pet Weight', 'Pet Age','option 1','option 2','option 3','create at','update at');

    $callback = function() use($Clients, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($Clients as $Client) {
            $row['code']  = $Client->client_code;
            $row['name']    = $Client->name;
            $row['email']    = $Client->email;
            $row['phone']  = $Client->phone;
            $row['status']  = $Client->active_status;
            $row['activate_date']  = $Client->active_date??"-";
            $row['created_at']  = $Client->created_at??"-";
            $row['updated_at']  = $Client->updated_at??"-";
            $row['vet']  = Vet::find($Client->vet_id)->vet_name??$Client->vet_id;
            $row['vet_id']  = $Client->vet_id;
            
            $row['option 1']  = $Client->option_1??0;
            $row['option 2']  = $Client->option_2??0;
            $row['option 3']  = $Client->option_3??0;
            // $option = explode("-", $Client->phoneIsVerified);
            // // dd(str_contains($option[1],'standard'),str_contains($option[1],'extra'));
            // if( is_array($option) ){
            //     $row['offerBasic'] = count($option)>1?str_contains($option[1],'standard'):"";
            //     $row['offerExtra'] = count($option)>1?str_contains($option[1],'extra'):"";
            // }

            $row['petName']  = $Client->pet_name;
            $row['petBreed']  = $Client->pet_breed;
            $row['petWeight']  = $Client->pet_weight;
            $row['petAge']  = $Client->pet_age_month.' Year '.$Client->pet_age_month.' Month';

            fputcsv($file, array($row['code'], $row['name'], $row['email'], $row['phone'], $row['status'], $row['activate_date'], $row['vet_id'], $row['vet'], $row['petName'],$row['petBreed'],$row['petWeight'],$row['petAge'],$row['option 1'],$row['option 2'],$row['option 3'],$row['created_at'],$row['updated_at']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
    
})->name('dl');

Route::get('/test',function(){
    $cs = Client::all();
    $cc =  array();
    // foreach($cs as $c){
    //     $ref =$c->phoneIsVerified;
    //     $arr = explode("-",$ref);
    //     // $arr = count($arr) > 1?explode(",",$arr[1]):null; 
    //     $cc[$c->id]['id'] = $c->id;
    //     $cc[$c->id]['select'] = $arr;

    //     $offerBasic = count($arr)>1?str_contains($arr[1],'standard'):null;
    //     $offerExtra = count($arr)>1?str_contains($arr[1],'extra'):null;
    //     // dd($cc,$offerBasic,$offerExtra);

    //     if($offerBasic){
    //         $b = new ClientInfo();
    //         $b->client_id = $c->id;
    //         $b->meta_name = 'selected_standard_option';
    //         $b->meta_type = 'boolean';
    //         $b->meta_value = true;
    //         $b->save();
    //     }
    //     if($offerExtra){
    //         $be = new ClientInfo();
    //         $be->client_id = $c->id;
    //         $be->meta_name = 'selected_extra_option';
    //         $be->meta_type = 'boolean';
    //         $be->meta_value = true;
    //         $be->save();
    //     }
    //     // dd($cc,$b,$be);
    // }
    // // dd($cc);
    // foreach($cc as $c){
    //     $cl = Client::find($c['id']);
    //     // $cli = ClientInfo::where('client_id',$c['id'])->get()??new ClientInfo();
    //     $cli = new ClientInfo();
    //     $cli->client_id = $c['id'];


    //     // $cli->cilent_id = $c['id'];
    //     dd($cl,$cli);
    // }
    // $info = new ClientInfo();
    // $info->client_id = 49;
    // $info->meta_name = 'selected_standard_option';
    // $info->meta_type = 'boolean';
    // $info->meta_value = true;
    // $info->save();
    // dd($info);
});

Route::get('/upuser',function(){

    //seed data
    $csvFile = fopen(base_path("database/data/vet-Table.csv"), "r");

    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        if (!$firstline) {
            $u = User::create([
                "id" => $data['1'],
                "name" => $data['1'],
                "email" => $data['1'],
                'email_verified_at' => now(),
                "password"=> Hash::make($data['1']), // password
            ]);
        }
        $firstline = false;
    }

    fclose($csvFile);
});
Route::get('/upvet',function(){

    //seed data
    $csvFile = fopen(base_path("database/data/vet-Table.csv"), "r");

    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        if (!$firstline) {
            $v = Vet::create([
                "id" => $data['1'],
                "vet_name"=>$data['3'],
                "vet_area" => $data['4'],
                "vet_city" => $data['5'],
                "vet_province" => $data['6'],
                "user_id"=>$data['1'],
            ]);
            // print($v->vet_name.$v->user_id );
        }
        $firstline = false;
    }

    fclose($csvFile);
});

use App\Http\Livewire\Webview;
Route::get('/view', Webview::class );
// function(){
//     Echo $_SERVER["HTTP_X_REQUESTED_WITH"]. '<br>';
//     Echo $_SERVER["HTTP_USER_AGENT"] ;
// });
