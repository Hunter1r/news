<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class AddNewsTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test1CreateNewsSuccess()
    {
        DB::table('categories')->insert(['name' => 'test category']);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->type('#date', '01.01.2022')
                    ->type('title', 'test title from test')
                    ->type('author', 'author from test')
                    ->check('active')
                    ->select('category_id', 1)
                    ->press('Create')
                    ->assertPathIs('/admin/news');
        });
    }

    public function test2CreateNewsFailure()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->type('#date', '01.01.2022')
                    ->type('title', '')
                    ->type('author', 'author from test')
                    ->check('active')
                    ->select('category_id', 1)
                    ->press('Create')
                    ->assertSee('Поле Заголовок необходимо заполнить')
                    ->assertPathIs('/admin/news/create');
        });
    }
}
