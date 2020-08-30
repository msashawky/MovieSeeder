<?php

namespace Modules\MoviesAPI\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\MoviesAPI\Entities\Category;
use Modules\MoviesAPI\Entities\Movie;
use DB;

class StoreMoviesAndCategoriesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $categories = json_decode(file_get_contents(moviesCategoriesURL()));//moviesCategoriesURL() From Helper
        for ($i = 0; $i<count($categories->genres); $i++){
            DB::table('categories')->insert(['id'=>$categories->genres[$i]->id,'name'=>$categories->genres[$i]->name]);
        }
        $movies = json_decode(file_get_contents(moviesURL()));//moviesCategoriesURL() From Helper
        for ($i = 0; $i<count($movies->results); $i++){
            DB::table('movies')->insert(['id'=>$movies->results[$i]->id,'title'=>$movies->results[$i]->title, 'popularity'=>$movies->results[$i]->popularity,'vote_average'=>$movies->results[$i]->vote_average,'genre_ids'=>json_encode($movies->results[$i]->genre_ids)]);
        }
    }
}
