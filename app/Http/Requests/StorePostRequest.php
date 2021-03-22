<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        define('MAX_POSTS_ALLOWED', 100000);
        return [
            "user_id" => ["required", "exists:users,id",function($attribute, $value, $fail){
                if (Post::where("user_id", $value)->count()>=MAX_POSTS_ALLOWED && !$this->id)
                    $fail('User has Exceeded max post which are '.MAX_POSTS_ALLOWED);
            }],
            "title" => ["required", "min:3", "unique:posts,title," . $this->id],
            "description" => ["required", "min:10"],
            'image' => 'mimes:jpeg,png',
            "tags" => "string"
        ];
    }
}
