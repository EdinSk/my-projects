<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'user_id'];

    // A like belongs to a blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // A like belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}