<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnonceRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if(request()->isMethod('post')) {
            return [
                'titre' => 'required|string|max:258',
                'date' => 'required|date',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ];
        } else {
            return [
                'titre' => 'required|string|max:258',
                'date' => 'required|date',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ];
        }
    }

    public function messages()
    {
        if(request()->isMethod('post')) {
            return [
                'titre.required' => 'Titre is required!',
                'date.required' => 'Date is required!',
                'description.required' => 'Descritpion is required!',
              'image.required' => 'Image is required!',


            ];
        } else {
            return [
                'titre.required' => 'Titre is required!',
                'date.required' => 'Date is required!',
                'description.required' => 'Descritpion is required!',
                'image.required' => 'Image is required!',

            ];
        }
    }
}
