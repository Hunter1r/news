<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;

    public function getCategories() {

        $categories = Category::select('id as category_id', 'name as category_name')->paginate(10);

        return $categories;
    }

    public function getCategoryById(int $id) {

        $categories = \DB::select("SELECT categories.id, categories.name FROM categories WHERE id=:id", ['id' => $id]);

        return $categories;
    }
}
