<?php


namespace Modules\MoviesAPI\Interfaces;


interface MoviesRepositoryInterface
{
    public function getPopularMovies();
    public function getTopRatedMovies();

}
