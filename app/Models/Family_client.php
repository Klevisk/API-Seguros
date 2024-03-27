<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family_client extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'dato_id',
        'relationship'
    ] ;

    public function dato()
    {
        return $this->belongsTo(Dato::class, 'dato_id');
    }

    public function client()
{
    return $this->belongsTo(Client::class, 'client_id');
}

}
