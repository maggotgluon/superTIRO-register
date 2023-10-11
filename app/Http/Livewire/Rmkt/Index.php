<?php

namespace App\Http\Livewire\Rmkt;

use App\Models\Client;
use App\Models\rmkt_client;
use App\Models\Vet;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $step, $phone,$currentVet;
    public $otp_code,$vet_code;
    public $offer_1,$offer_2,$offer_3;
    public $errorStatus;
    public $client_data;
    public $vet,$vetall;
    public $vet_province,$vet_city,$vet_area,$vet_id;
    public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;
    public $readyToLoad = false;
    public function mount($phone=null){
        $this->phone = $phone;
        if($phone == null){
            $this->step = -1;
        }else{
            $this->loadclientdata();
            $this->next(2);
        }
        
        
        // $this->phone=000;
        // dd($this->loadclientdata());
    }
    public function requestOTP(){
        // validate phone field and database
        // dd($validatePhone);
        $validatedData = $this->validate([
            'phone' => ['required', 'numeric',
            // 'digits:10','min:10',
            'regex:/^([0-9\s\(\)]*)$/'],
        ]);
        // todo:request otp
        // next to 1
        $client=Client::firstWhere('phone',$this->phone);
        if($client){
            // dd($client);
            // dd(rmkt_client::all(),rmkt_client::firstWhere('client_id',$client->client_code));
            // if status pending or not activated go to old loop
            $this->next(1);
        }else{
            $this->next(-2);
            // return redirect(route('index'));
        }
    }
    public function validateOTP(){
        // validate otp field
        $validatedData = $this->validate([
            'otp_code' => ['required', 'numeric',
            // 'digits:10','min:10',
            'regex:/^([0-9\s\(\)]*)$/'],
        ],
        ['phone.required' => 'โปรดกรอกหมายเลขโทรศัพท์ของคุณที่ลงทะเบียนไว้']
        );
        
        
        // validate otp api
        // next to 2
        // validate 
        $this->loadclientdata();
        $this->next(3);
    }

    public function loadclientdata(){
        $this->client_data = Client::firstWhere('phone',$this->phone);
        $this->vet_id = $this->client_data->vet_id;
        $this->next(3);
        // dd($this->client_data);
    }
    public function updateVet(){
        $this->currentVet=Vet::find($this->vet_id);
        // $this->loadclientdata();
        // dd($this->client_data,$this->vet_id);
        $this->next(3);
    }
    public function savermktdata(){
        $rmkt=rmkt_client::updateOrCreate([
            'client_id'=>$this->client_data->id,
            'active_status'=>null
        ],[
            'vet_id'=>$this->vet_id,
            'active_status'=>'pending'
        ]);
        $this->next(8);
    }
    public function verifyVetCode(){
        $verify=$this->vet_code==$this->vet_id;
        $check = $this->offer_2||$this->offer_3;
        if($verify && $check){
            if($this->client_data->active_status=='activated'){
                $this->errorStatus=2;
                // $this->next(7);
                return;
            }
            //create client with re remark
            // dd($this->client_data);
            
                //code...
                $rmkt=rmkt_client::updateOrCreate([
                    'client_id'=>$this->client_data->id,
                    'active_status'=>'pending'
                ],[
                    'vet_id'=>$this->vet_id,
                    'option_1'=>$this->offer_1??null,
                    'option_2'=>$this->offer_2??null,
                    'option_3'=>$this->offer_3??null,
                    'active_date'=>now(),
                    'active_status'=>'activated'
                ]);
            try {
                $client_data=Client::create([
                    'phone'=>'rmkt-'.$this->client_data->phone,
                    'phoneIsVerified'=>'rmkt-'.$this->client_data->client_code,
                
                    'client_code'=>0,
                    'name'=>$this->client_data->name,
                    'email'=>null,
                    
                    'pet_name'=>$this->client_data->pet_name,
                    'pet_breed'=>$this->client_data->pet_breed,
                    'pet_weight'=>$this->client_data->pet_weight,
                    'pet_age_month'=>$this->client_data->pet_age_month,
                    'pet_age_year'=>$this->client_data->pet_age_year,
                    'vet_id'=>$this->vet_id,
                    'option_1'=>$this->offer_1??null,
                    'option_2'=>$this->offer_2??null,
                    'option_3'=>$this->offer_3??null,
                    'active_date'=>now(),
                    'active_status'=>'activated'
                ]);
    
                $client_data->client_code = 'TRIO'.Str::padLeft($client_data->id, 5, '0');
                $client_data->save();
            } catch (\Throwable $th) {
                throw $th;
            }
            
            // dd($client_data,$this->client_data);
            $this->client_data=$client_data;
            $this->next(7);
        }else{
            if(!$verify){
                $this->errorStatus=1;
                $this->vet_code=null;
            }
            if($check){
                $this->errorStatus=1;
                $this->vet_code=null;
            }
            

        }
    }
    public function loadAddr(){
        $this->readyToLoad = true;
        $this->vet = Vet::all();
        $this->vet_province = Vet::orderBy('vet_province','asc')->distinct('vet_province')->pluck('vet_province');

    }
    public function updatedSelectedVetProvince($selected_vet_province){
        $this->vetall = Vet::all();
        $this->vet_city =$this->vetall->where('vet_province',$selected_vet_province)->unique('vet_city');
        $this->vet=$this->vetall->where('vet_province',$selected_vet_province);
        $this->selected_vet_city=null;
        $this->selected_vet_area=null;
        
    }
    public function updatedSelectedVetCity($selected_vet_city){
        $this->vet_area =$this->vetall->where('vet_city',$selected_vet_city)->unique('vet_area');
        $this->vet=$this->vetall->where('vet_city',$selected_vet_city);
        $this->selected_vet_area=null;
    }
    public function updatedSelectedVetText($selected_vet_text){
        $this->vet=$this->vetall->where('vet_name',"%{$selected_vet_text}%");
    }

    public function render()
    {
        /* if($this->step==3){
            $this->loadclientdata();
        } */
        return view('livewire.rmkt.index')->layout('layouts.guest');
    }

    public function next($loc=null){
        $this->step=$loc??$this->step+1;
        // dd($this->step);
    }
    public function goHome(){
        return redirect(route('index'));
    }
}
