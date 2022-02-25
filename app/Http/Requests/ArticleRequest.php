<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            // On instancie des règles lors de la saisie formulaire d'un article (nouveau ou modifié)
            // On requiert dans la BD que le champ 'title' SOIT unique, ce qui poser pb si le champs 'title'
            // n'est pas modifié ce qui sera le cas à 99%.
            // Pour remédier à cela on fait appel à la methode 'Rule' qui indiquera
            // en fonction de la méthode appelée create/POST vs update/PUT
            // que la règle 'unique' doit être ignorée lors de la modif d'un article avec update/PUT 
            'title' => $this->method() == 'POST' ?
                ['required', 'max:20', 'unique:articles,title'] :
                ['required', 'max:20', Rule::unique('articles', 'title')->ignore($this->article)],
            'content'   => ['required'],
            'category'  => ['sometimes', 'nullable', 'exists:categories,id']
        ];
    }
}
