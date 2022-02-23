<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsModel = new News();
        $news = $newsModel->getNews();
        
        return view('admin.news.index', ['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsModel = new News();
        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();
        return view('admin.news.create', ['categories'=>$categories, 'news'=>$newsModel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newsModel = new News();
        $newsModel->fill($request->except('_token'));
        $newsModel->slug = Str::of($request->input('title'))->slug('-');
        if($request->has('active')) {
            $newsModel->active = 1;
        } else {
            $newsModel->active = 0;
        }
        $newsModel->save();
        return redirect()->route('admin.news.index')
        ->with('status', 'News is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();
        return view('admin.news.create', ['news'=>$news, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = News::all()->find($id);
        $item->fill($request->except('_token'));
        $item->slug = Str::of($request->input('title'))->slug('-');
        if($request->has('active')) {
            $item->active = 1;
        } else {
            $item->active = 0;
        }
        $item->save();
        return redirect()->route('admin.news.index')
        ->with('status', 'Item news is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $id = $news->id;
        $author = $news->author;
        $title = $news->title;

        $news->delete();
        return response()->json(['id'=>$id, 'title'=>$title, 'author'=>$author]);

        // return redirect()->route('admin.news.index')
        // ->with('status', 'Item news is deleted');

    }
}
