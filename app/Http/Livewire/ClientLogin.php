<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class ClientLogin extends Component
{
    public $phone;
    public $error='';

    public function render()
    {
        return view('livewire.client-login');
    }

    public function login(){
        $this->error='';
        if(Client::where('phone',$this->phone)->first()){
            redirect( route('client.ticket',['phone'=>$this->phone]) );
        }else{
            $this->error = 'error user not found';
        }
    }
}
