<?php


namespace Modules\MoviesAPI\Repositories;

use Carbon\Carbon;
use Composer\DependencyResolver\Request;
use Modules\MoviesAPI\Entities\Category;
use Modules\MoviesAPI\Entities\Movie;
use Modules\MoviesAPI\Interfaces\MoviesRepositoryInterface;
use Modules\MoviesAPI\Jobs\StoreMoviesAndCategoriesJob;
use Modules\MoviesAPI\Jobs\StoreMoviesJob;

class MoviesRepository implements MoviesRepositoryInterface
{
    protected $category;
    protected $movie;
    public function __construct(Category $category, Movie $movie)//Constructor Injection
    {
        $this->category = $category;
        $this->movie = $movie;
    }

    public function getPopularMovies()
    {
        return $this->movie->all();
    }
    public function getCategories()
    {
        return $this->category->all();
    }
    public function getMoviesByCategory($category_id){
        return $this->movie->where('genre_ids', 'LIKE', '%'. $category_id.'%')->get();//Movie may be under more than one category
    }
    public function getMoviesByVoteAndPopularity($popular, $rate){
        return $this->movie->orderBy('vote_average',$rate)->orderBy('popularity',$popular)->get();
    }

    public function getTopRatedMovies(){
        return json_decode(file_get_contents(topRatedMoviesURL()));//topRatedMoviesURL() From Helper
    }
    public function getRecentlyMovies(){
        return json_decode(file_get_contents(recentlyMoviesURL()));//recentlyMoviesURL() From Helper
    }
    //Store Categories From API to DB
    public function createMoviesCategories(){
        $categories = json_decode(file_get_contents(moviesCategoriesURL()));//moviesCategoriesURL() From Helper
        for ($i = 0; $i<count($categories->genres); $i++){
            $this->category->insert(['id'=>$categories->genres[$i]->id,'name'=>$categories->genres[$i]->name]);
        }
//        $categoriesJob = (new StoreMoviesAndCategoriesJob())->delay(Carbon::now()->addSeconds(5));
//        dispatch($categoriesJob);
    }
    //Create Movies from API to DB
    public function createMovies(){
        $movies = json_decode(file_get_contents(moviesURL()));//moviesCategoriesURL() From Helper
        for ($i = 0; $i<count($movies->results); $i++){
            $this->movie->insert(['id'=>$movies->results[$i]->id,'title'=>$movies->results[$i]->title, 'popularity'=>$movies->results[$i]->popularity,'vote_average'=>$movies->results[$i]->vote_average,'genre_ids'=>json_encode($movies->results[$i]->genre_ids)]);
        }
//        $moviesJob = (new StoreMoviesJob)->delay(Carbon::now()->addSeconds(10));
//        dispatch($moviesJob);

    }

    public function storeMoviesByQueues(){
        $job = (new StoreMoviesAndCategoriesJob())->delay(Carbon::now()->addSeconds(5));
        dispatch($job);
    }


}
