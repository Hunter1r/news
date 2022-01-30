<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getCategories() {

        $categories = \DB::select("SELECT categories.id, categories.name FROM categories");

        return $categories;
    }

    public function getCategoryById(int $id) {

        $categories = \DB::select("SELECT categories.id, categories.name FROM categories WHERE id=:id", ['id' => $id]);

        return $categories;
    }
}
