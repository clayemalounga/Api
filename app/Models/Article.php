<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function aimes()
    {
        return $this->hasMany(Aime::class);
    }

    public function cathegorie()
    {
        return $this->belongsTo(CathegorieArticle::class);
    }
}
