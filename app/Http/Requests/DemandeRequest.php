<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client_id' => 'required|exists:clients,idClient',
            'description' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'nombre_personne' => 'required|integer|min:1',
            'type_de_celebration' => 'required|string|max:255',
        ];
    }
}

