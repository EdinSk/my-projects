<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recommendation>
 */
class RecommendationFactory extends Factory
{

    protected $model = \App\Models\Recommendation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from_user_id' => User::all()->random()->id,
            'to_user_id'   => User::all()->random()->id,
            'content'      => $this->faker->paragraph,
            'created_at'   => now(),
        ];
    }
}
