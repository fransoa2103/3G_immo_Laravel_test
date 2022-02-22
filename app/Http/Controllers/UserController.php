<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function funcProfile(string $username){
        return "<h1>Hi, je suis ".$username."</h1>";
    }
}
