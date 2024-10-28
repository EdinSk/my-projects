<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationPreference>
 */
class NotificationPreferenceFactory extends Factory
{
    protected $model = \App\Models\NotificationPreference::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'             => User::all()->random()->id,
            'notification_target' => $this->faker->randomElement(['Email', 'SMS', 'Push']),
            'notification_topic'  => $this->faker->randomElement(['Events', 'Blogs', 'Updates']),
            'created_at'          => now(),
        ];
    }
}
