<?php
/*
| Modification des paramètres de langue et des messages d'erreur 
| on peut modifier la langue EN en FR dans App\Lang en y ajoutant le dossier FR.zip
| téléchargeable sur github https://github.com/Laravel-Lang/lang
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{
    ArticleController,
    UserController,
    RegisterController,
    LoginController,
    LogoutController
};

// Redirection de la home page
Route::get('/', [ArticleController::class, 'index']);

// Créer un controller restfull ArticleController
route::resource('articles',ArticleController::class)->except('index');

// Appel et traitement de la page du formulaire de connexion
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('post.login');

// Appel et traitement de la page de déconnexion
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

// Appel et traitement de la page du formulaire d'inscription
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('post.register');

Route::get('profile/{user}', [UserController::class, 'funcProfile'])->name('user.profile');

