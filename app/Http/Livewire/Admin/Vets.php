<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\stock;
use App\Models\Vet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Vets extends Component
{
    use WithPagination;

    public $stock;
    public $vet_list;
    public $all_vets;
    
    public $search='',$order='id',$sort='desc';

    public $sort_icon=[
        'id'=>'',
        'vet_name'=>'',
    ];

    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'id'],
        'sort'=> ['except' => 'desc']
    ];
    public function mount(){
        $this->stock = stock::sum('total_stock');
        // $this->all_client = Client::all();
        $this->all_vets = vet::with('client')->with('stock')->get();

        foreach ($this->all_vets as $index => $vet) {
            $this->vet_list[$index]['id']=$vet->id;
            $this->vet_list[$index]['name']=$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
    }
    
    public function order($order){
        $this->sort_icon=[
            'id'=>'',
            'vet_name'=>'',
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
    public function render()
    {
        // $this->order 
        $vets=vet::with('client')->with('stock')->orderBy($this->order,$this->sort)->paginate(50);
        // dd($vets[0]->stock->total_stock);
        foreach($vets as $k=>$v){
            $v->stocks = $v->stock->total_stock;
            $v->stocks_adj = $v->stock->stock_adj;
            $v->total_client = $v->client->count();
            
            $vet = $this->all_vets->where('stock_id',$v->stock_id);
            $v->total_client_activated = 0;
            $v->total_client_pending = 0;
            $v->total_client_await = 0;
            $v->vet_total = 0;
            foreach ($vet as $key => $vs) {
                
                $v->total_client_opt1+=$vs->client->where('active_status','activated')->where('option_1',1)->count();

                $v->total_client_activated+=$vs->client->where('active_status','activated')->count();
                $v->total_client_pending+=$vs->client->where('active_status','pending')->count();
                $v->total_client_await+=$vs->client->where('active_status','await')->count();
                $v->vet_total+=$vs->client->count();
            }

            // $v->total_client_activated = $v->client->where('active_status','activated')->count();
            // $v->total_client_pending = $v->client->where('active_status','pending')->count();
            // $v->total_client_pending = $v->client->where('active_status','await')->count();
        }
        // dd($vets);

        // dd(Vet::with('vet_infos')->get());
        return view('livewire.admin.vets',[
            'vets'=>$vets,'total'=>$this->stock
        ])->extends('layouts.app');;
    }
}
