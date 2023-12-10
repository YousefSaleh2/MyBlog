<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use uploadImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.post.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create' , compact('categories'));
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
            'image'       => ['nullable' , 'image' , 'mimes:png,jpg,jpeg,gif,sug' , 'max:2048'],
            'title'       => ['required' , 'string'],
            'content'       => ['required' , 'string'],
            'smallDesc'       => ['required' , 'string'],
            'tag'       => ['required' , 'string'],
            'category_id'       => ['required' ],
        ]);

        $path = $this->uploadImage($request , 'posts' , 'image');

        Post::create([
            'image'         => $path,
            'title'         => $request->title,
            'content'       => $request->content,
            'smallDesc'     => $request->smallDesc,
            'tag'           => $request->tag,
            'category_id'   => $request->category_id,
            'user_id'       => Auth::user()->id
        ]);

        return redirect()->route('posts.index')
                        ->with('success','Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.post.edit' , compact('post' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => ['required' , 'string'],
            'content'       => ['required' , 'string'],
            'smallDesc'       => ['required' , 'string'],
            'tag'       => ['required' , 'string'],
            'category_id'       => ['required'],
        ]);

        $post->update([
            'title'         => $request->title,
            'content'       => $request->content,
            'smallDesc'     => $request->smallDesc,
            'tag'           => $request->tag,
            'category_id'   => $request->category_id,
        ]);
        return redirect()->route('posts.index')
                        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
                        ->with('success','Post deleted successfully');
    }

    public function show_deleted()
    {
        $posts=Post::onlyTrashed()->get();
        return view('admin.post.show_deleted' , compact('posts'));
    }


    public function force_deleted(string $id)
    {
        Post::withTrashed()->where('id' , $id )->forceDelete();
        return redirect()->route('posts_show_deleted')
                        ->with('success','Post deleted permanently');
    }


    public function restore(string $id)
    {
        Post::withTrashed()->where('id' , $id )->restore();
        return redirect()->route('posts_show_deleted')
                        ->with('success','Post restored successfully');
    }
}
