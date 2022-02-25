<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // autorise un utilisateur à valider un formulaire
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // règle définies lors de la saisie d'un formulaire
            'title'     => ['required', 'max:20', 'unique:articles,title'],
            'content'   => ['required'],
            'category'  => ['sometimes', 'nullable', 'exists:categories,id']
        ];
    }
}
