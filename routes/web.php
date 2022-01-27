<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ImportNewsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses'=>'App\Http\Controllers\Controller@index']);

Route::get('/hello/{name}', fn (string $name) => 
    "Hello {$name}"
);

Route::get('/about', fn () => view('about')
);


Route::resource('/feedback', FeedbackController::class);
Route::resource('/news/import', ImportNewsController::class);



// Route::get('/news/import', fn () => view('importNewsForm'))->name('news.import');

Route::get('/news', fn () => 
    "News page"
);

Route::get('/news/{category}', [NewsController::class, 'getNewsByCategory'])
->name('news.category');

Route::get('/news/{category}/{id}', [NewsController::class, 'getNewsItem'])
->where('id', '\d+')
->name('news.item');

Route::get('/category', [CategoryController::class, 'index']);