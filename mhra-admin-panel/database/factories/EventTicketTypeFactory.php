<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventTicketType>
 */
class EventTicketTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\EventTicketType::class;

    public function definition()
    {
        return [
            'event_id'    => Event::all()->random()->id,
            'ticket_name' => $this->faker->randomElement(['Standard', 'VIP', 'Early Bird']),
            'price'       => $this->faker->randomFloat(2, 50, 500),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
