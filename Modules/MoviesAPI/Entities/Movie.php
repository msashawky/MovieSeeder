<?php

namespace Modules\MoviesAPI\Entities;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $table = "movies";
    protected $fillable = ['id','vote_average','popularity','title'];
    protected $casts = [
        'genre_ids' => 'array'
    ];
}
