<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Blog::class;

    public function definition()
    {
        return [
            'title'      => $this->faker->sentence,
            'author_id'  => User::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
