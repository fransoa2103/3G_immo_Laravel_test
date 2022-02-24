<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    // ici on retourne l'article ($this) qui appartient à l'utilisateur
    // grace à la fonction 'belongsTo'
    public function user(){
        return $this->belongsTo(User::class);
    }

    // cette fuonction récupère le slug de l'article
    public function getRouteKeyName(){
        return 'slug';
    }
}
