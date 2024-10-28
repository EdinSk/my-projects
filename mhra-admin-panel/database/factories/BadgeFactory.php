<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Badge>
 */
class BadgeFactory extends Factory
{

    protected $model = \App\Models\Badge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence,
            'icon_url'    => $this->faker->imageUrl(64, 64, 'abstract'),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
