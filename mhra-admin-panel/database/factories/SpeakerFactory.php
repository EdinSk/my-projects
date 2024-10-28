<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speaker>
 */
class SpeakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Speaker::class;

    public function definition()
    {
        return [
            'first_name'     => $this->faker->firstName,
            'last_name'      => $this->faker->lastName,
            'title'          => $this->faker->jobTitle,
            'bio'            => $this->faker->paragraph,
            'photo_url'      => $this->faker->imageUrl(200, 200, 'people'),
            'facebook_url'   => $this->faker->url,
            'linkedin_url'   => $this->faker->url,
            'instagram_url'  => $this->faker->url,
            'x_url'          => $this->faker->url,
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
