<?php

namespace Modules\MoviesAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MoviesResource extends JsonResource
{

    //for security and manipulate with data
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'vote_average' => $this->vote_average,
            'popularity' => $this->popularity,
            'genre_ids' => $this->genre_ids,
        ];
    }

}
