<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\Vet;
use App\Models\stock;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $all_client;
    public $vets;
    public $stock;

    public $vet_list;
    
    public $search='',$order='id',$sort='asc';

    public $sort_icon=[
        'id'=>'',
        'updated_at'=>'',
        'name'=>'',
        'active_status'=>'',
    ];

    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'id'],
        'sort'
    ];
    
    public function order($order){
        $this->sort_icon=[
            'id'=>'',
            'updated_at'=>'',
            'name'=>'',
            'active_status'=>'',
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

    public function mount(){
        // $this->all_vet = Vet::all();

        // $this->client_info = ClientInfo::all();
        $this->all_client = Client::with('vet')->get();
        $this->vets = vet::with('client')->with('stock')->get();
        $this->stock = stock::with('vet')->get();
        
        foreach ($this->vets as $index => $vet) {
            $this->vet_list[$index]['id']=$vet->id;
            $this->vet_list[$index]['name']=$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
    }
    public function render()
    {
        // $this->client = Client::orderBy($this->order,$this->sort);
        
        $client = Client::with('vet')->orderBy($this->order,$this->sort)->paginate(10);
        foreach($client as $k=>$c){
            $c->vet_name = $c->vet->vet_name;
            $c->vet_stock_id = $c->vet->stock_id;
            $c->vet_stock = $this->stock->find($c->vet->stock_id)->total_stock;
            $vet = $this->vets->where('stock_id',$c->vet_stock_id);
            $c->vet_total_activated = 0;
            $c->vet_total = 0;
            foreach ($vet as $key => $value) {
                $c->vet_total_activated+=$value->client->where('active_status','activated')->count();
                $c->vet_total+=$value->client->count();
            }
            $c->vet_regis = $this->all_client->where('vet_id','like',$c->stock_id.'%')->count();
            
        }
        // dd(getType($client),getType($this->client));
        return view('livewire.admin.dashboard',[
            // 'clients'=>Client::orderBy($this->order,$this->sort)->paginate(10)]
            'clients'=>$client]
        );
    }
}
