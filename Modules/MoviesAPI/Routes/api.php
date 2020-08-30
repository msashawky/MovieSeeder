<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/moviesapi', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'categories'], function(){
    Route::get('/','MoviesAPIController@categories');
    Route::get('/create','MoviesAPIController@createCategories');
});
Route::group(['prefix'=>'movies'], function(){
    Route::get('create','MoviesAPIController@createMovies');
    Route::get('popular','MoviesAPIController@movies');
    Route::get('/','MoviesAPIController@filterMoviesByCategory');
    Route::get('/','MoviesAPIController@filterMoviesByRateAndPopularity');
});
