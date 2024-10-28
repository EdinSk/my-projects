<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author_id',
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function sections()
    {
        return $this->hasMany(BlogSection::class, 'blog_id')->orderBy('order', 'asc');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function relatedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_relations', 'blog_id', 'related_blog_id');
    }

    public function relatedToBlogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_relations', 'related_blog_id', 'blog_id');
    }

    public function likes()
    {
        return $this->hasMany(BlogLike::class);
    }

    // Check if the blog is liked by a particular user
    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    // Search method for blogs by title and author
    public static function search($search)
    {
        return static::where('title', 'like', '%' . $search . '%')
            ->orWhereHas('author', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    }
}
