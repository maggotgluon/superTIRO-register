<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'meta_name',
        'meta_type',
        'meta_value'
    ];
    
    public function info(){
        return $this->belongsTo(Client::class);
    }
}
