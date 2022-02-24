<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function funcProfile(User $user){
        return "<h1>je suis l'utilisateur numéro #".$user->name."</h1>";
    }
}
