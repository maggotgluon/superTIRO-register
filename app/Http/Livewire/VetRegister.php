<?php

namespace App\Http\Livewire;

use App\Models\ThailandAddr;
use App\Models\User;
use App\Models\Vet;
use Livewire\Component;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class VetRegister extends Component
{
    public $name,$email,$password,$password_confirmation;
    public $vet_name, $vet_province, $vet_city, $vet_area,$vet_id;
    public $addr, $thai;

    public function mount()
    {
        $this->thai = ThailandAddr::all();
        $this->addr = array();
        $this->addr['Tambon'] =null; //$thai->unique('Tambon');
        $this->addr['District'] =null; //$thai->unique('District');
        $this->addr['Province'] =$this->thai->unique('Province');

    }
    public function render()
    {
        return view('livewire.vet-register');
    }
    public function updatedVetProvince($vet_province){
        $this->addr['District'] =$this->thai->where('Province',$vet_province)->unique('District');
        $this->vet_city=null;
        $this->vet_area=null;
    }
    public function updatedVetCity($vet_city){
        $this->addr['Tambon'] =$this->thai->where('District',$vet_city)->unique('Tambon');
        $this->vet_area=null;
    }

    public function save(){
        $validatedData = $this->validate([
            'vet_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'vet_id' => ['required','unique:vets,id']
        ]);
        
        $this->addr['Tambon'] = $this->thai->where('Tambon',$this->vet_area)->unique('Tambon');
        
        // dd('TRIO'.$vet_id.Vet::all()->count());
        $user = User::create([
            'id' => $this->vet_id,
            'name' => $this->vet_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        // $vet_id = Arr::first($this->addr['Tambon'])->id.Str::padLeft($user->id,3,0);
        
        $Vet = Vet::create([
            'id'=> $this->vet_id,
            'vet_name' => $this->vet_name,
            'vet_province' => $this->vet_province,
            'vet_city' => $this->vet_city,
            'vet_area' => $this->vet_area,
            'user_id' => $user->id,
            'user_id' => $user->id
        ]);
        dd($this->vet_id,$user,$Vet);


        // event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
