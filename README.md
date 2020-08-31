

## Steps to run The project
- git clone of the master branch
- generate laravel key uusing the artisan command: php artisan key:generate
- run composer install
- renaming .env.example to .env with the connections according to the environment.
- run php artisan migrate


## How to seed the DB from the live API
- run the custom comand  php artisan movies:create (this command can be found in App\Commands\CreateMovies.php). 
- this command will get the movies and categories data from the API and store it to the DB.

## Another way to store data (using Queues)
- run (php artisan queue:work)
- It will run a specific job found at (Modules\MoviesAPI\Jobs\StoreMoviesAndCategoriesJob.php)

##Project Structure and Used packages
- [Laravel 5.8](https://laravel.com/docs/5.8)
- [Laravel Modules](https://github.com/nWidart/laravel-modules)
- Repository Design Pattern: found in (Modules\MoviesAPI\Repositories\), the repository class implements an interface that puts some conventions to the written methods.
-Controllers only call for repository methods
## For any questions
Please contact me at msashawky@gmail.com for any questions it will be more than welcome.
## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
