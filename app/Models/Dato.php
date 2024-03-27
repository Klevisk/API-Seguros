<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'city',
        'phone',
        'address',
        'email',
    ];



    public function client()
    {
        return $this->hasMany(Client::class,'dato_id'); // Relación 'hasOne' con la tabla 'clients'
    }
    public function providers()
    {
        return $this->hasMany(Provider::class, 'dato_id');
    }
    public function family()
    {
        return $this->hasMany(Family_client::class, 'dato_id');
    }

}
