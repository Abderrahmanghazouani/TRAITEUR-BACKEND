<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'idClient';

    protected $fillable = [
        'nom',
        'numero',
        'email',
    ];

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'client_id', 'idClient');
    }
}
