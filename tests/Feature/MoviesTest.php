<?php

namespace Tests\Feature;

use Modules\MoviesAPI\Entities\Movie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function moviesList()
    {
        $this->get('/api/movies?category_id=18&popular=desc&rated=desc')
            ->assertStatus(200);
    }
    /** @test */
    public function categoriesList()
    {
         $this->get('/api/categories')
         ->assertStatus(200);
    }

}
