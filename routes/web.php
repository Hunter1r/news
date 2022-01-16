<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
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

Route::get('/news', fn () => 
    "News page"
);

// Route::get('/news/{id}', [NewsController::class, 'getNewsItem']
// );

Route::get('/news/{category}', [NewsController::class, 'getNewsByCategory']
);

Route::get('/news/{category}/{id}', [NewsController::class, 'getNewsItem'])
->where('id', '\d+');

Route::get('/category', [CategoryController::class, 'index']);