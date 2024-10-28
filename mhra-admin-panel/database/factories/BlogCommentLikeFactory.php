<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BlogComment;
use App\Models\BlogCommentLike;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCommentLike>
 */
class BlogCommentLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\BlogCommentLike::class;

    public function definition()
    {
        return [
            'comment_id' => BlogComment::factory(),
            'user_id'    => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (BlogCommentLike $like) {
            // Ensure uniqueness by checking existing likes
            while (\App\Models\BlogCommentLike::where('comment_id', $like->comment_id)
                ->where('user_id', $like->user_id)
                ->exists()) {
                $like->user_id = User::factory()->create()->id;
            }
        });
    }
}
