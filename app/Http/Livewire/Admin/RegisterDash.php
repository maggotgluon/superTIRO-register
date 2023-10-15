<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class RegisterDash extends Component
{
    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
    public function render()
    {
        $client = Client::all();
        return view('livewire.admin.register-dash',[
            'c'=>$client
        ]);
    }
}
