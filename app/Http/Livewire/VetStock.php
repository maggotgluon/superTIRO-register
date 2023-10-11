<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Vet;
use App\Models\VetInfo;
use Livewire\Component;
use Livewire\WithPagination;


class VetStock extends Component
{
    use WithPagination;
    public $vet_list,$VetSelect;
    public $vet_id;

    public function mount()
    {
        $vet_all = Vet::all();


        foreach ($vet_all as $index => $vet) {
            $this->vet_list[$index]['id']=$vet->id;
            $this->vet_list[$index]['name']=$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
        // dd(Vet::find(1234)->info->where('meta_name','stock')->firstOrFail()->meta_value);
    }
    public function updatedVetSelect(){
        $vetSearch = Vet::find($this->VetSelect);
        dd($vetSearch);
    }

    public function render()
    {
        return view('livewire.vet-stock',
            ['vets'=>Vet::paginate(10),
             'clients'=>Client::paginate(10)]
        );
    }
}
