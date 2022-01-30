<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    public function index() {

    }

    public function getNewsByCategory($category_id) {

        $newsModel = new News();
        $categoryModel = new Category();

        $categories = $categoryModel->getCategories();
        $filteredNews = $newsModel->getNewsByCategory($category_id);
        
        return view('layouts.newsByCategory', ['news'=>$filteredNews,
    'categories' => $categories]);

    }

    public function getNewsItem($category_id, $id) {
        
        $newsModel = new News();
        $categoryModel = new Category();

        $categories = $categoryModel->getCategories();
        
        $item = $newsModel->getNewsItem($category_id,$id);
        
        if(empty($item)){
            abort(404);
        }
        return view('layouts.newsItem', ['item'=>$item[0], 'categories' => $categories]);
    }
}
