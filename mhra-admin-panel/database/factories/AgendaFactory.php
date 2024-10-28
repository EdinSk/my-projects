<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Agenda::class;

    public function definition()
    {
        return [
            'event_id'    => Event::all()->random()->id,
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }

}
