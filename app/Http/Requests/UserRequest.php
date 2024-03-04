<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom'=> 'required',
            'prenom' => 'required',
            'email' => 'required',
            'password' =>'required'
        ];
    }
    public function messages(){
        return[
            'nom.required' => 'Le champs nom ne doit pas etre vide',
            'prenom.required' => 'Le champs prenom ne doit pas etre vide',
            'email.required' =>'Le champs mail ne doit pas etre vide',
            'password.required' => 'Le champs mot de pass ne doit pas etre vide'
        ];
    }
}
