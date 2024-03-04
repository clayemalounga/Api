<?php

use App\Http\Controllers\Api\V1\AimeController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\Api\V1\CommentaireController;
use App\Http\Controllers\Api\V1\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Les routes pour recuperer les donnees dans la base de donnee.
Route::group(['prefix' => 'v1'], function()
{
    
    // ------ connection de l'utilisateur et deconnection

    Route::post('/users/authentification',[LoginController::class,'login'])->name('users.authentification');
    Route::delete('/users/deconnection',[LoginController::class,'logout'])->name('users.deconnexion');

    //  ----- Fin de connexion et deconnexion 

    Route::apiResource('/users', UserController::class);
    Route::apiResource('/articles', ArticleController::class);
    Route::apiResource('/commentaires', CommentaireController::class);
    Route::apiResource('/aimes', AimeController::class);
});
