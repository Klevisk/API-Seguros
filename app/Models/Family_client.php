<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family_client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'document',
        'city',
        'phone',
        'address',
        'client_id',
        'relationship'
    ] ;

}
