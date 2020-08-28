<?php



/**
 * Create a new token.
 *
 * @param \App\User $user
 * @return string
 */



// topRatedMoviesURL
if (!function_exists('topRatedMoviesURL')) {
    function topRatedMoviesURL()
    {
        return 'https://api.themoviedb.org/3/movie/top_rated?api_key=c9e5427159fb320bf4f1fc57f76a4270&language=en-US&page=1';
    }

}







