<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        DB::table('categories')->insert(['name'=>'test_category']);
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->screenshot('test_screen')
                    ->storeSource('test_source')
                    ->storeConsoleLog('test_console')
                    ->assertSee('Top News');
        });
    }
}
