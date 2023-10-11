<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\Vet;
use App\Models\stock;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Builder;

class DashboardV2 extends Component
{
    use WithPagination;

    public $all_client;
    public $vets;
    public $stock;
    public $vet_list;

    public $search='',$order='updated_at',$sort='desc';

    public $sort_icon=[
        'id'=>'',
        'updated_at'=>'',
        'name'=>'',
        'active_status'=>'',
        'vet_id'=>'',
    ];

    public function order($order){
        $this->sort_icon=[
            'id'=>'',
            'updated_at'=>'',
            'name'=>'',
            'active_status'=>'',
            'vet_id'=>'',
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


    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'updated_at'],
        'sort'=> ['except' => 'desc']
    ];
    public function mount(){
        $this->all_client = Client::all();
        // $this->clients = Client::with('vet');
        $this->vets = vet::with('client')->with('stock')->get();
        $this->stock = stock::with('vet')->get();
        // dd($clients[0]->vet->vet_name, $vets[0]->client);
    }

    public function logout(){
        auth()->guard('web')->logout();
        return redirect('/admin');
    }
    public function render()
    {
        
        $client = Client::with(['vet'])->orderBy($this->order,$this->sort)->paginate(50);
        
        foreach($client as $k=>$c){
            // dd($c->vet->vet_name);
            $c->vet_name = $c->vet->vet_name??'-';
            $c->vet_stock_id = $c->vet->stock_id??'-';
            $c->vet_stock = $c->vet?$this->stock->find($c->vet->stock_id)->total_stock:0;
            $vet = $this->vets->where('stock_id',$c->vet_stock_id);
            $c->vet_total_activated = 0;
            $c->vet_total_pending = 0;
            $c->vet_total = 0;
            foreach ($vet as $key => $value) {
                $c->vet_total_activated+=$value->client->where('active_status','activated')->where('option_1','1')->count();
                $c->vet_total_pending+=$value->client->where('active_status','<>','activated')->count();
                $c->vet_total+=$value->client->count();
            }
            // $c->pending = $c->vet_total - $c->vet_total_activated;
            $c->vet_regis = $this->all_client->where('vet_id','like',$c->stock_id.'%')->count();
            
        }
        // dd($client->paginate(50));
        return view('livewire.admin.dashboard-v2',[
            'clients'=>$client
        ])->extends('layouts.app');
    }
}
