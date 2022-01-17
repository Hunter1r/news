<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        
        $news = $this->getNews();
        $categories = $this->getCategories($news);

        return view('category', ['categories' => $categories]);
    }
}
