<?php

namespace Modules\MoviesAPI\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = "categories";
    protected $fillable = ['id','name'];
}
