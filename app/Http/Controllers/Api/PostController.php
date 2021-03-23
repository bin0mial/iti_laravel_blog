<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::with(['user', 'tags', 'comments'])->paginate(5));
    }

    public function show(Post $post){
        return new PostResource($post);
    }

    public function store(PostRequest $request){
        $validated = $request->validated();
        if(isset($validated["tags"])) {
            $validated["tags"] = explode(",", $validated["tags"]);
        }
        $post = Post::create($validated);
        return new PostResource($post);
    }
}
