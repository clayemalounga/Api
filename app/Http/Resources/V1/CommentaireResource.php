<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tableauCommentaires = [
            'id' => $this->id,
            'descriptionCommentaire' => $this->description,
            'articleId' => $this->article_id,
            'userId' => $this->user_id,
            'dateCreation' => $this->created_at
        ];

        return $tableauCommentaires;
    }
}
