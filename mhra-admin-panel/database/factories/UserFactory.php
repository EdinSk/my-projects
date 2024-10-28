<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'email'           => $this->faker->unique()->safeEmail,
            'password'        => Hash::make('123456'), // or bcrypt('password')
            'role'            => 'user',
            'bio'             => $this->faker->paragraph,
            'title'           => $this->faker->jobTitle,
            'phone'           => $this->faker->phoneNumber,
            'city'            => $this->faker->city,
            'country'         => $this->faker->country,
            'cv_url'          => $this->faker->url,
            'photo_url'       => $this->faker->imageUrl(200, 200, 'people'),
            'acquired_points' => $this->faker->numberBetween(0, 5000),
            'created_at'      => now(),
            'updated_at'      => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    // State to create admin users
    public function admin()
    {
        return $this->state([
            'role' => 'admin',
        ]);
    }
}
