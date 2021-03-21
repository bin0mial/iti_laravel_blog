<?php
namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class PostShowResponse implements Responsable{
    private $post;
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function toResponse($request)
    {
        if($request->ajax()){
            return response()->view("posts.show", ["post" => $this->post, "ajax"=>true]);
        }
        else
            return response()->view("posts.show", ["post" => $this->post]);
    }
}
