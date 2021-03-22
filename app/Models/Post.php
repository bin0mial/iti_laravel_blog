<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable, SluggableScopeHelpers;
    use HasTags;

    protected $fillable = [
        "title",
        "description",
        "user_id",
        "image",
        "tags"
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getPostImage($image){
        if($image){
            return Storage::disk('local')->url('public/posts/'.$image.'.jpg');
        }
        return null;
    }

    public function getImageAttribute($value){
        return Storage::url($value);
    }

    public function setImageAttribute($value){
        $path = $value? $value->storePublicly("public/".$this->user_id):null;
        $this->attributes['image'] = $path;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getHumanReadableDate()
    {
        return $this->created_at->format('l jS \\of F Y h:i:s A') ;
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
