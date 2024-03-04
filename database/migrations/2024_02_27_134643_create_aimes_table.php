<?php

use App\Models\Article;
use App\Models\User;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aimes', function (Blueprint $table) {
            $table->id();
            $table->integer("nombre_like");
            $table->foreignIdFor(Article::class);
            $table->foreignIdFor(User::class);
            $table->boolean("is_like");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aimes');
    }
};
