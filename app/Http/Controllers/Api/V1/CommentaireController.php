<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Requests\CommentaireRequest;
use App\Http\Resources\V1\CommentaireResource;
use App\Http\Resources\V1\CommentaireCollection;
use App\Models\Article;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentaireController extends Controller
{
    // recuperons les donnees dans la base de donnee
    public function index()
    {
        return new CommentaireCollection(Commentaire::paginate());
    }
    public function store(CommentaireRequest $request)
    {
        // recuperons l'article avec son identifiant 
        $article = Article::find($request->input('article_id'));
        if (!$article) {

            return response()->json(['error' => 'Oups!!! article nom trouvee '],404);
        }
        // creons un commantaire
        $commentaire = new Commentaire();
        $commentaire->description = $request->description;
        $commentaire->user_id = auth()->user()->id;
        $commentaire->article_id = $article->id;
        $commentaire->save();
        return response()->json(['message' => 'Commentaire ajoute avec success'],200);
    }
    public function show(Commentaire $commentaire)
    {
        return new CommentaireResource($commentaire);
    }

    public function update(CommentaireRequest $request, Commentaire $commentaire)
    {

        // tester si le commentaire appartient a l'utilisateur
        if($commentaire->user_id == auth()->user()->id)
        {
            $commentaire->description = $request->description;
            $commentaire->save();
            return response(['message'=>'Le commentaire supprimer avec succes'],200);
        }
        return response(['message'=>'Oups! vous ne pouvez pas mettre a jour ce commentaire '],403);

    }

    public function destroy(Commentaire $commentaire)
    {
        // testons si le commentaire appartient a l'utilisateur
        if($commentaire->user_id == auth()->user()->id)
        {
            $commentaire->delete();
            return response(['message'=>'Le commentaire supprimer avec succes'],200);
        }
        return response(['message'=>'Oups! vous ne pouvez pas supprimer ce commentaire '],403);
    }
}
