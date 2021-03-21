<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect()->route("posts.index");
    }

    public function restore(Request $request, $postId){
        Post::withTrashed()->find($postId)->restore();
        return redirect()->back();
    }

    public function show(Post $post)
    {
        return view("posts.show", ["post" => $post]);
    }

    public function edit(Post $post)
    {
        return view("posts.edit", ["post" => $post, "users" => User::all()]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route("posts.index");
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
