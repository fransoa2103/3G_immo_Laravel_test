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
| CHAPITRE 7 BLADE
|--------------------------------------------------------------------------
| Création d'un dossiers LAYOUTS + 1 fichier main.php
| similaire à ob_start et ob_clean avec PHP
| utilistaion des syntaxes 
|       @extends ('nom du fichier')
|       @section('content')
|       @stop
| puis insertion dans le fichier destinataire de la ligne de commande 
|       @yierd('content')
*/
route::get('test', function()
{
    // return view('test')->withTitle('LARAVEL');
    return view('test', ['title' => 'LARAVEL']);
});
route::get('test2', function()
{
    return view('test2', ['title' => 'PHP']);

});

/*
| Création d'un dossiers LAYOUTS + 1 fichier main.php
| similaire à ob_start et ob_clean avec PHP
| utilistaion des syntaxes 
|       @extends ('nom du fichier')
|       @section('content')
|       @stop
| puis insertion dans le fichier destinataire de la ligne de commande 
|       @yierd('content')
*/
// méthode 1
// route::get('test3/{number}', function($number)
// {
//     return view('structure', $number);
// });
// méthode 2
route::get('test3', function()
{
    // $fruits = ['orange','citron','banane','pomme','raisin'];
    $fruits = [];
    $data = ['number'=> 4, 'fruits' => $fruits];
    return view('structure', $data);
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
