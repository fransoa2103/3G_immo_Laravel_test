<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    // ici on retourne l'article ($this) qui appartient à l'utilisateur)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
