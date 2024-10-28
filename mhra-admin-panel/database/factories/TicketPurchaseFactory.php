<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Event;
use App\Models\EventTicketType;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketPurchase>
 */
class TicketPurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\TicketPurchase::class;

    public function definition()
    {
        $event = Event::all()->random();
        $ticketType = EventTicketType::where('event_id', $event->id)->get()->random();

        return [
            'user_id'        => User::all()->random()->id,
            'event_id'       => $event->id,
            'ticket_type_id' => $ticketType->id,
            'price'          => $ticketType->price,
            'purchase_date'  => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
