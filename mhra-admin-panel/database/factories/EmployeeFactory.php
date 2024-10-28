<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Employee::class;

    public function definition()
    {
        return [
            'first_name'   => $this->faker->firstName,
            'last_name'    => $this->faker->lastName,
            'title'        => $this->faker->jobTitle,
            'bio'          => $this->faker->paragraph,
            'photo_url'    => $this->faker->imageUrl(200, 200, 'people'),
            'social_links' => json_encode([
                'twitter'  => $this->faker->url,
                'linkedin' => $this->faker->url,
            ]),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
