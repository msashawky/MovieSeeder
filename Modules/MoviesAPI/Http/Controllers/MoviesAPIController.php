<?php

namespace Modules\MoviesAPI\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\MoviesAPI\Http\Resources\CategoriesResource;
use Modules\MoviesAPI\Http\Resources\MoviesResource;
use Modules\MoviesAPI\Repositories\MoviesRepository;
use DB;
class MoviesAPIController extends Controller
{
    protected $moviesRepository;

    public function __construct(MoviesRepository $moviesRepository)
    {
        $this->moviesRepository = $moviesRepository;
    }
    public function movies(){
        $movies = $this->moviesRepository->getPopularMovies();
        if($movies)
            return $this->apiResponse(MoviesResource::collection($movies));
        return $this->notFoundResponse("no movies found");
    }
    public function categories(){
        $categories = $this->moviesRepository->getCategories();
        if($categories)
            return $this->apiResponse(CategoriesResource::collection($categories));
        return $this->notFoundResponse("no categories found");
    }
//    public function filterMoviesByCategory($category_id){
//        $movies = $this->moviesRepository->getMoviesByCategory($category_id);
//        if($movies)
//            return $this->apiResponse(MoviesResource::collection($movies));
//        return $this->notFoundResponse("no movies found");
//    }
    public function filterMoviesByCategory(Request $request)
    {
        $category_id = $request->query('category_id');
        $movies = $this->moviesRepository->getMoviesByCategory($category_id);
        if($movies)
            return $this->apiResponse(MoviesResource::collection($movies));
        return $this->notFoundResponse("no movies found in that category");
    }
    public function filterMoviesByRateAndPopularity(Request $request)
    {
        $popular = $request->query('popular');
        $rated = $request->query('rated');
        $movies = $this->moviesRepository->getMoviesByVoteAndPopularity($popular, $rated);
        return $this->apiResponse(MoviesResource::collection($movies));
    }
    public function topRatedMovies(){
        $movies = $this->moviesRepository->getTopRatedMovies();//dd($movies->results);
        return $movies->results;
    }
    public function recentlyMovies(){
        $movies =$this->moviesRepository->getRecentlyMovies();
        return $movies->results;
    }

    public function createCategories(){
        $this->moviesRepository->createMoviesCategories();
    }
    public function createMovies(){
        $this->moviesRepository->createMovies();
    }
    public function createMoviesByQueue(){
        $this->moviesRepository->storeMoviesByQueues();
    }


}
