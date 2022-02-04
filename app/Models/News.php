<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function getNewsItem(int $category_id, int $id) {

        return News::select('news.id as news_id', 'title','date','slug','author','active','image','description','categories.id as category_id', 'categories.name as category_name')
        ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
        ->where('news.category_id', $category_id)
        ->where('news.id', $id)
        ->get();

    }

    public function getNewsByCategory(int $category_id) {

        return News::select('news.id as news_id', 'title','date','slug','author','active','image','description','categories.id as category_id', 'categories.name as category_name')
        ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
        ->where('category_id', $category_id)
        ->get();

    }

    public function getRndNews() {
        
        return News::select('news.id as news_id', 'title','date','slug','author','active','image','description','categories.id as category_id', 'categories.name as category_name')
        ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
        ->inRandomOrder()
        ->first();

    }
}
