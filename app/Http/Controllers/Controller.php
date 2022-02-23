<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\News;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $newsModel = new News();
        $model = new Category();
        $categories = $model->getCategories()->toArray();

        return view('layouts.mainNews', [
            'categories'=>$categories,
            'topNews0'=>$newsModel->getRndNews()->toArray(),
            'topNews1'=>$newsModel->getRndNews()->toArray(),
            'topNews2'=>$newsModel->getRndNews()->toArray(),
        ]);
    }

    public function getCategories($news) {
        $categories = [];

        foreach ($news as $item) {
            
            if (!in_array($item['category'], $categories, true)) {
                $categories[] = $item['category'];
            }
        }
        return $categories;
    }
}
