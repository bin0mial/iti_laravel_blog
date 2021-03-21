<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getHumanReadableDate()
    {
        return $this->created_at->format('l jS \\of F Y h:i:s A') ;
    }
}
