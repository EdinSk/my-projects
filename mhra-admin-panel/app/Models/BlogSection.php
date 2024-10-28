<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_id',
        'section_title',
        'section_body',
        'order',
    ];

    // Relationships
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
