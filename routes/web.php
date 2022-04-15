<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ImportNewsController;
use App\Http\Controllers\LoginController;
use App\Models\Category;
use App\Models\News;
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
// Route::get('/admin', fn () => view('admin.index')
// );

Route::group(['middleware'=>'auth'], function() {
    Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware'=>'admin'], function(){
        Route::view('/', 'layouts.adminMain')->name('admin');
        Route::resource('/categories', AdminCategoryController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/orders', AdminOrderController::class);
        Route::resource('/feedbacks', AdminFeedbackController::class);
        Route::match(['post', 'get'], '/profile', [
            'uses' => 'App\Http\Controllers\Admin\ProfileController@update',
            'as' => 'updateProfile'
        ]);
        Route::get('/parser',  [ParserController::class, 'index'])->name('parser');
        Route::post('images', [ImageController::class, 'store'])->name('images.store');
        Route::delete('remove/{news}', [ImageController::class, 'destroy'])->name('news.image.remove');        
    });
    Route::get('logout', function() {
        \Auth::logout();
        return redirect()->route('login');
    });

});



Route::resource('/feedback', FeedbackController::class);
Route::resource('/news/import', ImportNewsController::class);

Route::get('/auth/vk', [LoginController::class, 'loginVK'])->name('vkLogin');
Route::get('/auth/vk/response', [LoginController::class, 'responseVK'])->name('vkResponse');

// Route::get('/news/import', fn () => view('importNewsForm'))->name('news.import');

Route::get('/news', fn () => 
    "News page"
);

Route::get('/news/{category}', [NewsController::class, 'getNewsByCategory'])
->name('news.category');

Route::get('/news/{category}/{news}', [NewsController::class, 'getNewsItem'])
->where('id', '\d+')
->name('news.item');


// Route::get('/news/{category}/{news}', function(Category $category, News $news){
// // dd($news);
// view('layouts.newsItem', ['item'=>$news]);
// });



Route::get('/category', [CategoryController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
