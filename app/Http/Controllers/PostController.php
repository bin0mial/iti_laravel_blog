<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        [
            "id" => 1,
            "title" => "Learn PHP",
            "description" => "With supporting text below as a natural lead-in to additional content",
            "created_at" => "2018-04-10",
            "creator" => [
                "name" => "Ahmed",
                "email" => "ahmed@gmail.com",
                "created_at" => "Thursday 25th of December 1975 02:15:16 PM"
            ]
        ],
        [
            "id" => 2,
            "title" => "Solid Principles",
            "description" => "With supporting text below as a natural lead-in to additional content",
            "created_at" => "2018-04-12",
            "creator" => [
                "name" => "Mohamed",
                "email" => "mohamed@gmail.com",
                "created_at" => "Thursday 26th of December 1975 02:15:16 PM"
            ]
        ],
        [
            "id" => 3,
            "title" => "Design Patterns",
            "description" => "With supporting text below as a natural lead-in to additional content",
            "created_at" => "2018-04-13",
            "creator" => [
                "name" => "Ali",
                "email" => "ali@gmail.com",
                "created_at" => "Thursday 27th of December 1975 02:15:16 PM"
            ]
        ],
    ];

    private function fetchPostByIndex($postId): array
    {
        $post = array_filter($this->posts, function ($post) use ($postId) {
            return $post["id"] == $postId;
        });
        return !empty($post) ? array_pop($post) : [];
    }

    public function index()
    {
        return view("posts.index", ["posts" => $this->posts]);
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store()
    {
        return redirect()->route("posts.index");
    }

    public function show($postId)
    {
        $post = $this->fetchPostByIndex($postId);
        return view("posts.show", ["post" => $post]);
    }

    public function edit($postId)
    {
        $post = $this->fetchPostByIndex($postId);
        return view("posts.edit", ["post" => $post]);
    }

    public function update()
    {
        return redirect()->route("posts.index");
    }

    public function destroy()
    {
        return redirect()->route("posts.index");
    }
}
