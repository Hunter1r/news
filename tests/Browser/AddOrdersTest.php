<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Faker\Factory;

class AddOrdersTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test1CreateOrderSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/orders/create')
                    ->type('name', 'test name from test')
                    ->type('email', 'testmail@mail.com')
                    ->type('phone', '+874562134')
                    ->type('description', 'new test description from test')
                    ->press('Create')
                    ->assertPathIs('/admin/orders');
        });
    }

    public function test2CreateOrderFailure()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/orders/create')
                    ->type('name', '')
                    ->type('email', 'testmail@mail.com')
                    ->type('phone', '+874562134')
                    ->type('description', 'new test description from test')
                    ->press('Create')
                    ->assertSee('Поле name обязательно для заполнения')
                    ->assertPathIs('/admin/orders/create');
        });
    }
}
