<?php


namespace Modules\MoviesAPI\Interfaces;


interface MoviesRepositoryInterface
{
    public function getRecentlyMovies();
    public function getTopRatedMovies();

}
