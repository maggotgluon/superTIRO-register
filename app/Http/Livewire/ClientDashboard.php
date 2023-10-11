<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\ClientInfo;
use App\Models\Vet;
use App\Models\stock;
use Illuminate\Support\Arr;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Builder;

class ClientDashboard extends Component
{
    public Client $client;
    public $vet;
    public $stockRemain;

    public $phone;
    public $input_vet_id,$client_code;
    public $currentStep=1,$status=0;
    public $timeleft=0,$startTime,$endTime;
    public $leftMin,$leftSec;
    public $offer=[];
    public $offer_1,$offer_2,$offer_3;

    public $count=1 ;

    // public function increment(){
    //     $this->count+=1;
    // }
    // public function decrement(){
    //     $this->timeleft-=1;
    //     $this->leftMin=floor($this->timeleft/60);
    //     $this->leftSec=$this->timeleft - ($this->leftMin*60);
        
    //     if($this->client->active_status==='activated'){
    //         $this->go(6);
    //     }else if($this->timeleft==0){
    //         $this->go(5);
    //     }
    // }
    
    // public $firstname, $lastname, $phone,$email,$consent;
    // public $pet_name,$pet_breed,$pet_weight,$pet_age_month,$pet_age_year;
    
    // public Client $client;
    // public $vet,$vetall;
    // public $vet_province,$vet_city,$vet_area,$vet_id;
    // public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;

    // protected $listeners = ['clientLogin'];

    public function mount()
    {
        $this->client = Client::with('vet')->where('phone',$this->phone)->first();
        $this->client_code = $this->client->client_code;
        
        $vets = Vet::withCount([
            'client as client_all',
            'client as opt_1' =>function(Builder $query){
                $query->where('option_1', 1);
            },
        ])->where('stock_id',$this->client->vet->stock_id)->get();
        $all_opt1=0;
        $all_client=0;

        foreach ($vets as $key => $v) {
            $all_opt1 += $v->opt_1;
            $all_client += $v->client_all;
        }

        $stock=stock::find($vets->first()->stock_id);
// dd($this->client->option_1);
        $this->offer_1=$this->client->option_1??false;
        $this->offer_2=$this->client->option_2??false;
        $this->offer_3=$this->client->option_3??false;
        // dd($all_opt1);
        // dd($stock->total_stock,$all_opt1,$all_client);
        $this->stockRemain=$stock->total_stock - $all_opt1;
        if($this->client->active_status == 'activated'){
            $this->go(6);
        }
    }

    public function render()
    {
        
        return view('livewire.client-dashboard');
    }
    
    public function verifyVet()
    {
        if($this->offer_1||$this->offer_2||$this->offer_3){
            $this->client->option_1=$this->offer_1??false;
            $this->client->option_2=$this->offer_2??false;
            $this->client->option_3=$this->offer_3??false;
            // $t=$this->client->save();
        }else{
            $this->status=-2;
            return;
        }

        if($this->input_vet_id == $this->client->vet->user_id){
            //update record
            // dd('val');
            $this->client->active_date = now();
            $this->client->active_status = 'activated';
            $this->client->phoneIsVerified .= '-'.implode(",",$this->offer);
                
                
            $this->client->save();
            $this->go(6);

        }else{
            $this->status=-1;

        }
    }
    // public function countdown(){
        
    //     $this->startTime = Carbon::create($this->client->active_date);
    //     $this->endTime = Carbon::create($this->client->active_date)->addMinutes(15);
    //     $this->timeleft=Carbon::now()->diffInSeconds($this->endTime);
        
    //     if($this->endTime->isPast()){
    //         $this->go(5);
    //         $this->client->active_status = 'activated';
    //         $this->client->save();
    //     }else{
    //         $this->leftMin=$this->timeleft/60;
    //         $this->leftSec=$this->timeleft-($this->leftMin*60);
    //         $this->go(4);
    //     }
    // }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function go($step)
    {
        $this->currentStep = $step;
    }
}
