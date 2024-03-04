<?php

namespace App\Http\Controllers\Api\V1;
use  App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;
class UserController extends Controller
{
    // recuperer tous les utilisateurs.
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function create()
    {

    }

    public function store(UserRequest $request)
    {
        //les validations sont deja faites
        $user = new User();
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json([
            'message' => 'utilisateur enregistre avec succes',
            'status' => 200,
            'user'=> $user
        ]);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        // recuperons les donnees
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json([
            'message' => 'utilisateur modifier avec succes',
            'status' => 200,
            'user'=> $user
        ]);
        
    }

    public function delete(User $user)
    {
        $user = auth()->user();
        $user->delete();
        return  response()->json(
            [
                'message' => "Utilisateur supprimer avec succes",
                'status_code' => 200
            ]
        );
    }

}
