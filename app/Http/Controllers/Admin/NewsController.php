<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Services\UploadService;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {

        $created = News::create($request->validated() + [
            'slug' => Str::slug($request->input('title')),
            'active' => $request->has('active') ? 1 : 0
        ]);
        
        if($created) {
            return redirect()->route('admin.news.index')
            ->with('success', 'record is created');
        }
        return back()->with('error', 'News isn\'t added')
        ->withInput();

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
     * @param UpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $arr = $request->validated();
        if($request->has('active')) {
            $active = 1;
        } else {
            $active = 0;
        }
        $arr += [
            'slug' => Str::of($request->input('title'))->slug('-'),
            'active' => $active,
        ];

        $item = News::all()->find($id);

        if($request->hasFile('image')) {
            $arr['image'] = app(UploadService::class)->start($request->file('image'));
		}
        $item->fill($arr);
        
        if($item->save()) {
            return redirect()->route('admin.news.index')
            ->with('success', 'Item news is updated');
        }
        return back()->with('error', 'News isn\'t updated')
        ->withInput();
        
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
