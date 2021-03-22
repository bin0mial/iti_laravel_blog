<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        "title",
        "description",
        "user_id"
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
