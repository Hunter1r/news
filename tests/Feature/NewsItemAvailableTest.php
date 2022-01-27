<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsItemAvailableTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_newsItemViewAvailable()
    {
        $view = $this->view('layouts.newsItem', ['item'=>['id'=>1,'title'=>'some title','category'=>'sport','date'=>'01/01/2022','description'=>'some description'],
        'categories' =>['sport','travel','culture'] ]);

        $view->assertSee('some title');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_newsCategoryAvailable()
    {
        $response = $this->get('/news/{category}');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_newsItemAvailable()
    {
        // $response = $this->get('/news/{category}/{id}');
        // $response->assertStatus(200);
        $response = $this->get(route('news.item', ['category'=>'sport', 'id'=>1]));
        $response->assertStatus(200);
    }


    public function test_category()
    {
        $response = $this->get('/category', [CategoryController::class, 'index']);
        $response->assertStatus(200);
    }


    public function test_feedbackFormGetAvailable()
    {
        $response = $this->get(route('feedback.create'));
        $response->assertViewIs('feedbackForm');
    }

    public function test_feedbackFormPostAvailable()
    {
        $response = $this->post(route('feedback.store', ['name'=>'John', 'email'=>'John@mail.com', 'message'=>'test message for John']));
        $response->assertRedirect('/');
    }
 

    public function test_importNewsFormGetAvailable()
    {
        $response = $this->get(route('import.create'));
        $response->assertViewIs('importNewsForm');
    }

    public function test_importNewsFormPostAvailable()
    {
        $response = $this->post(route('import.store', ['name'=>'John', 'email'=>'John@mail.com', 'message'=>'test message for John', 'phone'=>'+7894565123']));
        $response->assertRedirect('/');
    }

    

}
