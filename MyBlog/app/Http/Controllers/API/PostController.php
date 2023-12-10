<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponseTrait;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;
    use uploadImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostResource::collection(Post::all());
        return $this->apiResponse($posts, 'ok', 200);
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
            'image'       => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,sug', 'max:2048'],
            'title'       => ['required', 'string'],
            'content'     => ['required', 'string'],
            'smallDesc'   => ['required', 'string'],
            'tag'         => ['required', 'string'],
            'category_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        if (!empty($request->image)) {

            $path = $this->uploadImage($request, 'posts', 'image');
        } else {
            $path = null;
        }


        $post = Post::create([
            'image'         => $path,
            'title'         => $request->title,
            'content'       => $request->content,
            'smallDesc'     => $request->smallDesc,
            'tag'           => $request->tag,
            'category_id'   => $request->category_id,
            'user_id'       => $request->user_id
        ]);

        if ($post) {
            return $this->apiResponse(new PostResource($post), 'Post created successfully', 200);
        }
        return $this->apiResponse(null, 'Post didn\'t create successfully', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post  $post)
    {
        if ($post) {
            return $this->apiResponse(new PostResource($post), 'ok', 200);
        }
        return $this->apiResponse(null, 'Category not found', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string  $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, 'Post not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'image'       => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,sug', 'max:2048'],
            'title'       => ['required', 'string'],
            'content'     => ['required', 'string'],
            'smallDesc'   => ['required', 'string'],
            'tag'         => ['required', 'string'],
            'category_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        if (!empty($request->image)) {
            $path = $this->uploadImage($request, 'posts', 'image');
        } else {
            $path = $post->image;
        }


        $post->update([
            'image'         => $path,
            'title'         => $request->title,
            'content'       => $request->content,
            'smallDesc'     => $request->smallDesc,
            'tag'           => $request->tag,
            'category_id'   => $request->category_id,
            'user_id'       => $request->user_id
        ]);

        if ($post) {
            return $this->apiResponse(new PostResource($post), 'Post updated successfully', 200);
        }
        return $this->apiResponse(null, 'Post didn\'t update successfully', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post  $post)
    {
        if (!$post) {
            return $this->apiResponse(null, 'Post not found', 400);
        }
        $post->delete();
        return $this->apiResponse(' ', 'Post deleted successfully', 200);
    }
    public function show_deleted()
    {
        $posts = Post::onlyTrashed()->get();
        if ($posts) {
            return $this->apiResponse(PostResource::collection($posts), 'ok', 200);
        }
        return $this->apiResponse(null, 'Post not found', 400);
    }


    public function force_deleted(string $id)
    {
        Post::withTrashed()->where('id', $id)->forceDelete();
        $post = Post::find($id);
        if ($post) {
            return $this->apiResponse(' ', 'Post deleted permanently', 200);
        }
        return $this->apiResponse(null, 'Post not found', 400);
    }


    public function restore(string $id)
    {
        Post::withTrashed()->where('id', $id)->restore();
        $post = Post::find($id);
        if ($post) {
            return $this->apiResponse(new PostResource($post), 'Post restored successfully', 200);
        }
        return $this->apiResponse(null, 'Post not found', 400);
    }
}
