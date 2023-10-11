<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\ClientInfo;
use App\Models\stock;
use App\Models\Vet as ModelsVet;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class VetDashboardV2 extends Component
{
    use WithPagination;
    
    public $current_vet,$current_client,$current_client_info;
    public $vet_id='';
    public $vet_list;
    public $sort_icon=[
        'client_code'=>'',
        'updated_at'=>'',
        'name'=>'',
        'active_status'=>''
    ];
    public $stock_adj;
    public $data=[];

    public $search='',$order='updated_at',$sort='desc';
    
    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'updated_at'],
        'sort'=> ['except' => 'desc']
    ];
    
    public function mount($vet_id){
        $this->stock_adj = 0;
        $vets = ModelsVet::all();
        $this->current_vet = $vets->firstwhere('user_id',$vet_id);
        $stock = stock::find($this->current_vet->stock_id);
        
        $this->vet_id = $this->current_vet->id;
        // dd($this->vet_id,$this->current_vet->id);

        $vets = ModelsVet::withCount([
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
                $query->where('option_3','>=', 1);
            },
            'client as c_activated' =>function(Builder $query){
                $query->where('active_status','activated');
            }
        ])->where('stock_id', $this->current_vet->stock_id)->get();
        // dd($vets);
        $all_opt1=0;
        $all_opt2=0;
        $all_opt3=0;
        $all_client=0;
        $all_activated=0;
        foreach ($vets as $key => $v) {
            $all_opt1 += $v->opt_1;
            $all_opt2 += $v->opt_2;
            $all_opt3 += $v->opt_3;
            $all_client += $v->client_all;
            $all_activated += $v->c_activated;
        }
        $this->data['all_client']=$all_client;
        $this->data['all_activated']=$all_activated;
        $this->data['all_opt1']=$all_opt1;
        $this->data['all_opt2']=$all_opt2;
        $this->data['all_opt3']=$all_opt3;
        $this->data['all_pending']=$all_client-$all_activated;
        // dd($all_client,$all_activated,$all_opt1,$this->data);


        $this->current_client = Client::where('vet_id',$this->vet_id)->get();
        // dd($this->current_vet,$vet_id);
        // foreach ($vets as $index => $vet) {
        //     $this->vet_list[$index]['id']=$vet->id;
        //     $this->vet_list[$index]['name']=$vet->vet_name;
        //     $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        // }
    }
    public function order($order){
        $this->sort_icon=[
            'client_code'=>'',
            'updated_at'=>'',
            'name'=>'',
            'active_status'=>''
        ];
        // dd($this->order == $order);
        if($this->order == $order && $this->sort=='asc'){
            $this->sort='desc';
        }else {
            $this->sort='asc';
        }
        // dd($this->sort);
        $sort_icon = $this->sort=='desc'?'sort-descending':'sort-ascending';
        $this->order = $order;
        $this->sort_icon[$order] = $sort_icon;
        $this->resetPage();
    }
    public function add_stock_adj(){ 
        $stock_adj = $this->stock_adj;

        if($stock_adj){
            $current = $this->current_vet->stock->total_stock;
            $adj = $this->current_vet->stock->stock_adj+1;
            // dd($current,$this->stock_adj,$adj);
            stock::updateOrCreate(
                ['id'=>$this->vet_id],
                ['total_stock'=>$current+$this->stock_adj,'stock_adj'=>$adj],
            );
        }else{
            return null;
        }

    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/admin');
    }
    public function render()
    {
        // dd($this->vet_id);
        $c=Client::where('vet_id',$this->vet_id)
            ->orderBy($this->order,$this->sort)
            ->paginate(25);
        // dd(Client::where('vet_id',$this->current_vet->user_id)->get());

        return view('livewire.vet-dashboard-v2',[
            'clients'=> $c
        ])->extends('layouts.app');
    }
}
