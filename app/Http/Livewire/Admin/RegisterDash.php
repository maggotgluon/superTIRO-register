<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use Livewire\Component;

class RegisterDash extends Component
{
    public function render()
    {
        $client = Client::all();
        return view('livewire.admin.register-dash',[
            'c'=>$client
        ]);
    }
}
