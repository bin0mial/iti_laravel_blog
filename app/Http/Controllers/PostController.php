<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Responses\PostShowResponse;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        return view("posts.index", ["posts" => Post::withTrashed()->paginate(5)]);
    }

    public function create()
    {
        return view("posts.create", ["users" => User::all()]);
    }

    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route("posts.index");
    }

    public function restore(Request $request, $postId){
        Post::withTrashed()->find($postId)->restore();
        return redirect()->back();
    }

    public function show(Post $post)
    {
        return new PostShowResponse($post);
    }

    public function edit(Post $post)
    {
        return view("posts.edit", ["post" => $post, "users" => User::all()]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route("posts.index");
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
