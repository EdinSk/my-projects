<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GeneralInfo>
 */
class GeneralInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\GeneralInfo::class;

    public function definition()
    {
        return [
            'hero_image_url' => $this->faker->imageUrl(1200, 600, 'business'),
            'social_links'   => json_encode([
                'facebook' => $this->faker->url,
                'twitter'  => $this->faker->url,
                'linkedin' => $this->faker->url,
            ]),
            'description'    => $this->faker->paragraphs(3, true),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
