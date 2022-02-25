<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    
    // Protection des champs lors de la création d'un article
    // ex: si un champ 'active_user' ou 'admin_user' existe, on ne veut pas qu'un utilisateur lambda puisse y acceder
    
    // MASS ASSIGNEMENT FILLABLE   
    // $fillable on y spécifie les champs que l'on souhaite créer
    // protected $fillable = ['user_id', 'title', 'slug', 'content', 'category_id'];
    
    // MASS ASSIGNEMENT GUARDED
    // $guarded on y spécifie les champs que l'on ne souhaite pas créer automatiquement,
    // et donc par défaut le tableau vide spécifie que tous les champs sont crées.
    // ici user_id et slug ne sont pas renseigné par l'utilisateur lors de la saisie du formaulaire article
    // user_id est automatiquement récupéré dans Auth
    // le slug est fabriqué par l'appel de setTitleAttribute
    
    
    protected $guarded  = ['user_id', 'slug'] ;
    public function setTitleAttribute($value)
    {
        $this->attributes['title']  = $value;        
        $this->attributes['slug']   = Str::slug($value);  
    }


    // ici on retourne l'article ($this)
    // un même utilisateur peut avoir plusieurs articles
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    // un même catégorie peut avoir plusieurs articles
    public function category(){
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'catégorie anonyme.'
        ]);
    }

    // cette fuonction récupère le slug de l'article
    public function getRouteKeyName(){
        return 'slug';
    }
}
