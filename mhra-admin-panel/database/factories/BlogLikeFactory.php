<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogLikeFactory extends Factory
{
    protected $model = BlogLike::class;

    public function definition()
    {
        return [
            'blog_id' => Blog::factory(), // Create or use an existing Blog
            'user_id' => User::factory(), // Create or use an existing User
        ];
    }
}
