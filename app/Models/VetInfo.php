<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VetInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'vet_id',
        'meta_name',
        'meta_type',
        'meta_value'
    ];
    public function getstock(){
        dd($this->vet_id);
        return '';
    }
    public function vet()
    {
        return $this->belongsTo(Vet::class);
    }
}
