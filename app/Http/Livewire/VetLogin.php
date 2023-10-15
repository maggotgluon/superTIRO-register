<?php

namespace App\Http\Livewire;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\Vet;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VetLogin extends Component
{
    public $vet_list,$vet_all;
    public $user_list;
    public $error;
    public $user,$password,$remember_me;
    public $adm,$adm_user;
    
    protected $rules = [
        'user' => 'required',
        'password' => 'required',
    ];

    public function mount(){
        
        $this->vet_all = DB::table('vets')->get();
    
        foreach ($this->vet_all as $index => $vet) {
            // dd($vet->user_id);
            $this->vet_list[$index]['id']=$vet->user_id;
            $this->vet_list[$index]['name']=$vet->user_id.' '.$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
    }
    public function render()
    {
        // dd($this->vet_list);
        return view('livewire.vet-login');
    }

    public function login(){
        // auth
        // $this->validate();
        $this->error='';
        // $login = User::find()
        // dd(User::find(1));// vet::find(10000341)->user()->id);
        $password = $this->password;
        $username = $this->user??$this->adm_user;
        $login = Auth::attempt(['name'=>$username,'password'=>$password] , $this->remember_me );
        // dd($login);
        // if($this->adm){
        // }else{
        //     $username = $this->user;
        //     // $username = vet::find($this->user)->user_id;
        //     $login = Auth::attempt(['name'=>$username,'password'=>$password] , $this->remember_me );
        //     // dd($username,$password,$login);
        // }

        // $user = user::find($username);
        // dd($login,$username,user::find($username),$password,$this->user);
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
        if( $login ){
            $user = user::find($username)??user::where('name',$username)->first();
            // dd($login,$username,$password,Hash::make($password),$user);
            
            Auth::login($user);

            return redirect(route('admin.registerDash'));    
            
        }else{
            // $this->reset();
            $this->error = 'error';
        }
        // dd( $this->user ,Auth::attempt(['id'=>$this->user,'password'=>$this->password] , $this->remember_me));
        

    }

}
