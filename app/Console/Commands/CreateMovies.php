<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\MoviesAPI\Repositories\MoviesRepository;

class CreateMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Movies and Categories';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $moviesRepository;
    public function __construct(MoviesRepository $moviesRepository)
    {
        parent::__construct();
        $this->moviesRepository = $moviesRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->moviesRepository->createMoviesCategories();
        $this->moviesRepository->createMovies();
    }
}
