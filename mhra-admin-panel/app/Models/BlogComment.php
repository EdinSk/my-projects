<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'user_id',
        'parent_comment_id',
        'content',
    ];

    // Relationships
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentComment()
    {
        return $this->belongsTo(BlogComment::class, 'parent_comment_id');
    }

    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_comment_id');
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class, 'comment_id'); // It should be 'comment_id'
    }

    // Check if the comment is liked by a specific user
    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
