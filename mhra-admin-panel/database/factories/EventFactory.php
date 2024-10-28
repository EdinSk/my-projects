<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Event::class;

    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('+1 days', '+1 year');
        $endDate = (clone $startDate)->modify('+' . rand(1, 3) . ' days');

        return [
            'title'           => $this->faker->sentence,
            'theme'           => $this->faker->word,
            'description'     => $this->faker->paragraph,
            'objective'       => $this->faker->sentence,
            'location'        => $this->faker->city,
            'start_date'      => $startDate,
            'end_date'        => $endDate,
            'event_type' => $this->faker->randomElement([
                Event::TYPE_HR_COFFEE,
                Event::TYPE_HR_WEEKEND,
                Event::TYPE_HR_WEBINAR,
                Event::TYPE_HR_CONFERENCE
            ]),
            'status'          => 'upcoming',
            'hero_image_url'  => $this->faker->imageUrl(800, 600, 'conference'),
            'created_at'      => now(),
            'updated_at'      => now(),
        ];
    }
}
