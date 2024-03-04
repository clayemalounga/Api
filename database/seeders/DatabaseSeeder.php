<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Aime;
use App\Models\CathegorieArticle;
use App\Models\Commentaire;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // creation des donnees dans la base de donnee
        $cat = CathegorieArticle::factory(3)->create();
        User::factory(3)->create()->each(function ($user) use ($cat)
        {
            //pour chaque client tu mets un article
            Article::factory(1)->create([
                'auteur' => $user->nom.' '.$user->prenom,
                'user_id' => $user->id,
                'cathegorie_article_id' => ($cat->random(1)->first())->id,
            ])->each( function ($article) use ($user){
                Commentaire::factory(1)->create([
                    'article_id' => $article->id,
                    'user_id' => $user->id,
                ]);
                Aime::factory(1)->create([
                    'article_id' => $article->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}
