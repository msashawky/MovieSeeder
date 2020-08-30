<?php


namespace Modules\MoviesAPI\Interfaces;


interface MoviesRepositoryInterface
{
    public function getPopularMovies();
    public function getTopRatedMovies();
    public function getCategories();
    public function getMoviesByCategory($category_id);

}
