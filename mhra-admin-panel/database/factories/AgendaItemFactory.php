<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Agenda;
use App\Models\Speaker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgendaItem>
 */
class AgendaItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\AgendaItem::class;

    public function definition()
    {
        return [
            'agenda_id'   => Agenda::all()->random()->id,
            'day_number'  => $this->faker->numberBetween(1, 3),
            'start_time'  => $this->faker->time('H:i:s'),
            'end_time'    => $this->faker->time('H:i:s'),
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'speaker_id'  => Speaker::all()->random()->id,
            'order'       => $this->faker->numberBetween(1, 10),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
