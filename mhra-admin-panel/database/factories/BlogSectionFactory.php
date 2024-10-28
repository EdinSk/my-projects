<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogSection>
 */
class BlogSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\BlogSection::class;

    public function definition()
    {
        return [
            'blog_id'       => Blog::all()->random()->id,
            'section_title' => $this->faker->sentence,
            'section_body'  => $this->faker->paragraphs(3, true),
            'order'         => $this->faker->numberBetween(1, 10),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
