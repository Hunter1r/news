<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function getNews() {

        return \DB::select('SELECT * FROM news');

    }

    public function getNewsById(int $id) {

        return \DB::select('SELECT * FROM news WHERE id=:id', ['id'=>$id]);

    }

    public function getNewsItem(int $category_id, int $id) {

        return \DB::select('SELECT news.id, news.date, title, slug, author, active, image, description, category_id, categories.name category 
        FROM news LEFT JOIN categories ON news.category_id=categories.id
        WHERE news.category_id=:category_id AND news.id=:id', ['category_id'=>$category_id, 'id'=>$id]);

    }

    public function getNewsByCategory(int $category_id) {

        return \DB::select('SELECT news.id, news.date, title, slug, author, active, image, description, category_id, categories.name category 
        FROM news LEFT JOIN categories ON news.category_id=categories.id WHERE category_id=:id', ['id'=>(int)$category_id]);

    }

    public function getRndNews() {
        
        return \DB::select('SELECT news.id, news.date, title, slug, author, active, image, description, category_id, categories.name category FROM news 
        LEFT JOIN categories ON news.category_id=categories.id ORDER BY RAND() LIMIT 1');

    }
}
