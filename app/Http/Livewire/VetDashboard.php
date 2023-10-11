<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\User;
use App\Models\Vet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Builder;

class VetDashboard extends Component
{
    public User $user;
    public $vet;
    public $clients,$clients_info;

    public $opt_1,$opt_2,$opt_3;
    public $opt_all,$opt_activated;
    
    public function mount($id=null){
        $this->user = Auth::user();
        if(!$this->user){
            $this->logout();
        }
        $this->vet = Vet::where('user_id',$id)->first();
        // dd($id,$this->vet,$this->user);
        $this->clients = $this->vet->client;
        $all_vet = Vet::withCount([
            'client as client_all',
            'client as opt_1_act' =>function(Builder $query){
                $query->where('option_1', 1)->where('active_status','activated');
            },
            'client as opt_1' =>function(Builder $query){
                $query->where('option_1', 1);
            },
            'client as opt_2' =>function(Builder $query){
                $query->where('option_2', 1);
            },
            'client as opt_3' =>function(Builder $query){
                $query->where('option_3', 1);
            },
            'client as c_activated' =>function(Builder $query){
                $query->where('active_status','activated');
            }])->where('stock_id',$this->vet->stock_id) ->get();
        $this->opt_1=0;
        $this->opt_2=0;
        $this->opt_3=0;
        $this->opt_all=0;
        $this->opt_activated=0;
        foreach ($all_vet as $the_vet) {
            $this->opt_all+=$the_vet->client_all;
            $this->opt_activated+=$the_vet->c_activated;

            $this->opt_1+=$the_vet->opt_1;
            $this->opt_2+=$the_vet->opt_2;
            $this->opt_3+=$the_vet->opt_3;
        }
        // dd($this->opt_1);
        // dd($this->vet,$this->clients);
        $this->clients_info = collect();
        // if($this->clients){
        //     foreach ($this->clients as $client) {
        //         foreach($client->info as $info){
        //             $this->clients_info->push($info);
        //             // [$info->meta_name] += $info->meta_value;
        //         }
        //     }
        // }
        // dd($this->user,$this->vet);
    }
    public function render()
    {
        // dd($this->user,$this->vet);
        return view('livewire.vet-dashboard');
    }
    public function filter($filter){
        $this->clients = $this->vet->client;
        $this->clients = $this->clients->where('active_status',$filter);
    }
    public function logout(){
        Auth::guard('web')->logout();
        return redirect(route('admin'));
    }
    public function humanTime($date_time){
        // dd($date_time);
        $date_time=Carbon::parse($date_time);

        return $date_time;
    }
    public function approvedClient($client_id){
        $client = Client::find($client_id);
        $client->active_status = 'activated';
        $client->save();
        $this->redirect('/dashboard');
        $this->render();
        // dd($client);

    }
    public function revokeClient($client_id){
        // dd($client_id);
        $client = Client::find($client_id);
        $client->active_date=null;
        $client->active_status = 'pending';
        $client->save();
        $this->redirect('/dashboard');
        $this->render();
    }

    public function exportCSV(){

        $fileName = 'client.csv';
        $Clients = Client::all();
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('code', 'name', 'email', 'phone', 'status', 'activate date', 'vet name' ,'Pet name', 'Pet bread', 'Pet Weight', 'Pet Age','basic offer','extra offer');

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
                $row['vet']  = Vet::find($Client->vet_id)->vet_name??$Client->vet_id;
                
                $option = explode("-", $Client->phoneIsVerified);
                // dd(str_contains($option[1],'standard'),str_contains($option[1],'extra'));
                if( is_array($option) ){
                    $row['offerBasic'] = count($option)>1?str_contains($option[1],'standard'):"";
                    $row['offerExtra'] = count($option)>1?str_contains($option[1],'extra'):"";
                }
    
                $row['petName']  = $Client->pet_name;
                $row['petBreed']  = $Client->pet_breed;
                $row['petWeight']  = $Client->pet_weight;
                $row['petAge']  = $Client->pet_age_month.' Year '.$Client->pet_age_month.' Month';
    
                fputcsv($file, array($row['code'], $row['name'], $row['email'], $row['phone'], $row['status'], $row['activate_date'], $row['vet'], $row['petName'],$row['petBreed'],$row['petWeight'],$row['petAge'],$row['offerBasic'],$row['offerExtra']));
            }
    
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
