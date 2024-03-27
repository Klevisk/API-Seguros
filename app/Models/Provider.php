<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
protected $fillable = [

    'dato_id'
] ;

public function safe()
{
    return $this->belongsToMany(Safe_type::class);
}

public function dato()
{
    return $this->belongsTo(Dato::class);
}

}
