<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryResource::collection(Category::all());
        return $this->apiResponse($categories , 'ok' , 200) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'    =>  ['required' , 'string'],
            'content'  =>  ['required' , 'string']
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null , $validator->errors() , 400);
        }

        $category = Category::create($request->all());

        if ($category) {
            return $this->apiResponse(new CategoryResource($category) , 'Category created successfully' , 200);
        }
        return $this->apiResponse(null , 'Category didn\'t create successfully' , 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if ($category) {
            return $this->apiResponse(new CategoryResource($category) , 'ok' , 200);
        }
        return $this->apiResponse( null , 'Category not found' , 404 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category  $category)
    {
        if (!$category) {
            return $this->apiResponse(null , 'Category not found' , 404 );
        }

        $validator = Validator::make($request->all(), [
            'title'    =>  ['required' , 'string'],
            'content'  =>  ['required' , 'string']
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null , $validator->errors() , 400);
        }

        $category->update($request->all());

        if ($category) {
            return $this->apiResponse(new CategoryResource($category) , 'Category updated successfully' , 200);
        }
        return $this->apiResponse(null , 'Category didn\'t update successfully' , 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category  $category)
    {
        if (!$category) {
            return $this->apiResponse(null , 'Category not found' , 400);
        }
        $category->delete();
        return $this->apiResponse(' ' , 'Category deleted successfully' , 200);
    }

    public function show_deleted()
    {
        $categories=Category::onlyTrashed()->get();
        if (count($categories)>0) {
            return $this->apiResponse(CategoryResource::collection($categories) , 'ok' , 200);
        }
        return $this->apiResponse(null , 'Category not found' , 400);
    }


    public function force_deleted(string $id)
    {
        Category::withTrashed()->where('id' , $id )->forceDelete();
        return $this->apiResponse(' ' , 'Category deleted permanently' , 200);
    }


    public function restore(string $id)
    {
        Category::withTrashed()->where('id' , $id )->restore();
        $category = Category::find($id);
        if (!$category) {
            return $this->apiResponse(null , 'Category not found' , 400);
        }
        return $this->apiResponse(new CategoryResource($category) , 'Category restored successfully' , 200);
    }
}
