<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'auteur'=> 'required',
            'description' => 'required',
            'media' => 'required',
            'cathegorie_article' =>'required'
        ];
    }
    public function messages(){
        return[
            'auteur.required' => 'Le champs auteur ne doit pas etre vide',
            'description.required' => 'Le champs description ne doit pas etre vide',
            'media.required' =>'Le champs ne doit pas etre vide',
            'cathegorie_article_id.required' =>'Le champs mail ne doit pas etre vide'

        ];
    }
}
