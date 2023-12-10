<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    =>  ['required' , 'string'],
            'content'  =>  ['required' , 'string']
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')
                        ->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = $category->posts;
        return view('admin.category.show' , compact('category' , 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title'    =>  ['required' , 'string'],
            'content'  =>  ['required' , 'string']
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }

    public function show_deleted()
    {
        $categories=Category::onlyTrashed()->get();
        return view('admin.category.show_deleted' , compact('categories'));
    }


    public function force_deleted(string $id)
    {
        Category::withTrashed()->where('id' , $id)->forceDelete();
        return redirect()->route('categories_show_deleted')
                        ->with('success','Category deleted permanently');
    }


    public function restore(string $id)
    {
        Category::withTrashed()->where('id' , $id)->restore();
        return redirect()->route('categories_show_deleted')
                        ->with('success','Category restored successfully');
    }
}
