<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'total',
        'provider_id',
        'client_id',
        'family_client_id',
        'safe_type_id',

    ] ;


    public function clients(){
        return $this->belongsToMany(Client::class);
    }

    public function providers(){
        return $this->belongsToMany(Provider::class);
    }

    public function familys(){
        return $this->belongsToMany(Family_client::class);
    }

    public function safe(){
        return $this->belongsToMany(Safe_type::class);
    }



}
