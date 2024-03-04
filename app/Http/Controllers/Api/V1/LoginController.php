<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Authentification de l'utilisateur
    public function login(LoginRequest $request)
    {
        // verifions la fiabiliter des information
        $tab = [
            'email' => $request->input('email'),
            'password' =>$request->input('password')
        ];

        // verifions en essayant de le connecter
        if(\Auth::attempt($tab))
        {
            // recuperons le user pour creer un jwt token
            $user = auth()->user();
            // creons le jeton
            $token = $user->createToken("CLE_VISIBLE_SUR _LE_BACKEND")->plainTextToken;
            return response()->json(
                [
                    'message' =>' Utilisateur authentifier',
                    'user' => auth()->user(),
                    'token' => $token
                ]
                ,200);
        }
        return response(['error' => 'Oups !!! erreur au niveau de la connexion'],404);
    }

    public function logout()
    {
        \Auth::logout();
        return response(['success' => 'Utilisateur deconnecter avec succes']);
    }
}
