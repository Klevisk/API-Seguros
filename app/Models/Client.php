<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
         'dato_id'
    ] ;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function datos()
    {
        return $this->belongsTo(Dato::class);
    }

    public function family()
{
    return $this->belongsTo(Family_client::class);
}
}
