<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Responses\PostShowResponse;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        if(isset($validated["tags"])) {
            $validated["tags"] = explode(",", $validated["tags"]);
        }
        Post::create($validated);
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

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route("posts.index");
    }

    public function destroy(Post $post)
    {
        Storage::delete($post->getRawOriginal("image"));
        $post->image = null;
        $post->save();
        $post->delete();
        return redirect()->back();
    }
}
