<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $primaryKey = 'idDemande';

    protected $fillable = [
        'client_id',
        'description',
        'lieu',
        'date_creation',
        'nombre_personne',
        'type_de_celebration',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'idClient');
    }
}
