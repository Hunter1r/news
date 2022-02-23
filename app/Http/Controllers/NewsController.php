<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    public function index() {

    }

    public function getNewsByCategory(Category $category) {
        
        $newsModel = new News();
        $categoryModel = new Category();

        $categories = $categoryModel->getCategories();
        $filteredNews = $newsModel->getNewsByCategory($category->toArray()['id']);
        
        return view('layouts.newsByCategory', ['news'=>$filteredNews->toArray(),
    'categories' => $categories->toArray()]);

    }

    public function getNewsItem(Category $category, News $news) {
        $newsModel = new News();
        $categoryModel = new Category();

        $categories = $categoryModel->getCategories()->toArray();
        
        $item = $newsModel->getNewsItem($category->toArray()['id'],$news->toArray()['id']);
        if(empty($item->toArray())){
            abort(404);
        }
        return view('layouts.newsItem', ['item'=>$item[0], 'categories' => $categories]);
    }
}
