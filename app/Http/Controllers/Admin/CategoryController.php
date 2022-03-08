<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();
        return view('admin.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categoryModel = new Category();
        return view('admin.categories.create', ['category'=>$categoryModel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {

        
        $category = Category::create($request->validated());
        if($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Category was created');
        }
        return back()->with('error', 'Category isn\'t added')
        ->withInput();

        // $categoryModel = new Category();
        // $categoryModel->fill($request->except('_token'));
        
        // $categoryModel->save();
        // return redirect()->route('admin.categories.index')
        // ->with('status', 'Category is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.create', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        

        $item = Category::all()->find($id);
        $item->fill($request->validated());
        if($item->save()) {
            return redirect()->route('admin.categories.index')
            ->with('success', 'Category is updated');
        }

        return back()->with('error', 'Category isn\'t added' )->withInput();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message'=>'category was deleted']);
    }
}
