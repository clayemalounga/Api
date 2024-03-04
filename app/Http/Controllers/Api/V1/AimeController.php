<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Resources\V1\AimeCollection;
use App\Models\Aime;
use App\Models\Article;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Http\Resources\V1\AimeResource;
class AimeController extends Controller
{   
    // Recuperons les donnees 
    public function index()
    {
        return new AimeCollection(Aime::paginate());
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        // variable static qui va compter le nombre d'article
        static $cpt  = 0; 

        $article = Article::find($request->input('article_id'));
        $aime = new Aime();
        $aime->nombre_like = $cpt++;
        $aime->article_id = $article->id; 
        $aime->user_id = auth()->user()->id;
        $aime->save();
        return response([
            'message'=>'Like valider avec success',
            'like'=>$aime,
        ]); 


    }
    public function show(Aime $aime)
    {
        return new AimeResource($aime);
    }
    public function update(Request $request, Aime $aime)
    {
        if($aime->user_id == auth()->user()->id)
        {
            
        }
    }
    public function delete(Aime $aime)
    {
        if($aime->user_id == auth()->user()->id)
        {
            $aime->delete();
            return response(['message'=>'like supprimer avec succes'],200);
        }
        return response(['error'=>'Oups!!! une erreur cest produite'],404);
    }
}
