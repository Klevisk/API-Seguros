<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safe_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'provider_id',
    ] ;

    public function provider()
{
    return $this->belongsToMany(Provider::class);
}

}
