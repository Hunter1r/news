<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index() {

    }

    public function getNewsByCategory($category) {
        $news = $this->getNews();
        $categories = $this->getCategories($news);
        $filteredNews = [];
        foreach($news as $key=>$value) {
            if ($value['category'] === $category) {
                $filteredNews[] = $news[$key];
            }
        }
        
        return view('layouts.newsByCategory', ['news'=>$filteredNews,
    'categories' => $categories]);

    }

    public function getNewsItem($category, $id) {
        $news = $this->getNews();
        $categories = $this->getCategories($news);
        $item = [];
        
        foreach($news as $key=>$value) {
            if ($value['category'] === $category && $value['id'] === (integer)$id ) { 
                $item[] = $news[$key];
            }
        }
        
        if(empty($item)){
            abort(404);
        }
        
        return view('layouts.newsItem', ['item'=>$item[0], 'categories' => $categories]);
    }
}
