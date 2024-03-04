<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'nombreDeLike' =>$this->nombre_like,
            'articleId' => $this->article_id,
            'userId' => $this->user_id,
            'isLike'=>$this->is_like,
        ];
    }
}
