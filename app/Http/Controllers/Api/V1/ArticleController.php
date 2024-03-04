<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Session\Session;
use App\Http\Resources\V1\ArticleResource;
use App\Http\Resources\V1\ArticleCollection;

class ArticleController extends Controller
{
    // recuperons les donnees
    public function index(Request $request)
    {
        // mettons le systeme de filtre ou recherche et celui de pagination

        // 1- recuperer tous les articles
        $article = Article::query();
        // 2- regarder au niveau de nore barre de navigation si notre utilisateur a mis le mot search
        $search = $request->input('search') || $request->input('filter') ? $request->input('search') : $request->input('filter') ;
        // 3 testons  en fonction de ceux qui est dans notre requete
        if($search)
        {
            $article = $article->where('auteur', 'LIKE', '%'.$search.'%')->get();
            return new ArticleCollection($article);
        }
        
        // return response()->json([
        //     'success'=>'Les donnes sont bien recu',
        //     'status'=> 200,
        //     'users'=> Article::paginate(),
        // ]);
        return new ArticleCollection(Article::all());
    }

    public function create()
    {

    }

    public function store(ArticleRequest $request)
    {
        // recuperons le media
        $filename = time().''.$request->media->extension();
        $mediaPath = $request->input('media')->storeAs('MediaArticle',$filename,'public');
        
        // ceration de l'article
        $article = new Article();
        $article->auteur = auth()->user()->nom.' '.auth()->user()->prenom;
        $article->desciption = $request->description;
        $article->media = $mediaPath;
        $article->user_id = auth()->user()->id;
        $article->cathegorie_article_id = $request->cathegorie;
        $article->save();
        //recuperons l'identifiant 
        return response()->json([
            'message' => 'Article ajouter avec succes',
            'atricle' => $article,
            'status_code' => 200
        ]);
    }

    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        //testons si dans notre request, nou avons le media
        if($request->media)
        {
            Storage::delete('public/'.$article->media);
        }
        // Enregistrons le chemin de decalage
        $filename = time().''.$request->media->extension();
        $mediaPath = $request->input('media')->storeAs('MediaArticle',$filename,'public');
        
        $article->auteur = auth()->user()->nom.' '.auth()->user()->prenom;
        $article->desciption = $request->description;
        $article->media = $mediaPath;
        $article->cathegorie_article_id = $request->cathegorie;
        $article->save();
        return response(['message'=>'Mise a jour effectuer'],200);

    }

    public function delete(Article $article)
    {
        // regardons le logo
        if($article->media)
        {
            Storage::disk('public')->delete($article->media);
        }
        $article->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Article supprimer avec succes',
        ]);
    }
}
