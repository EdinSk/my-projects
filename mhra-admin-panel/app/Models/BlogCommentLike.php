<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCommentLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_id',
        'user_id',
    ];

    // Relationships
    public function comment()
    {
        return $this->belongsTo(BlogComment::class, 'comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
