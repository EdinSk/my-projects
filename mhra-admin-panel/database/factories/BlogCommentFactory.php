<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogComment>
 */
class BlogCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\BlogComment::class;

    public function definition()
    {
        return [
            'blog_id'           => Blog::all()->random()->id,
            'user_id'           => User::all()->random()->id,
            'parent_comment_id' => null,
            'content'           => $this->faker->paragraph,
            'created_at'        => now(),
        ];
    }
}
