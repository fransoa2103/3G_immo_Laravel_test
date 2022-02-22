<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| CHAPITRE 6 CONTROLLER
|--------------------------------------------------------------------------
|
| Appel de function dans une class, ici on appelle:
| url      => cheminProfile (appelé helper url)
| class    => UserController
| fonction => funcProfile        
| en option on peut nommer cet appel de fonction ->name('user.profile')
|
*/
use App\Http\Controllers\
{
    ArticleController,
    UserController
};

Route::get('chemin/{username}', [UserController::class, 'funcProfile'])->name('user.profile');

/*
|
| Créer un controller restfull ArticleController, le relier à ses routes
|
*/
route::resource('articles',ArticleController::class);