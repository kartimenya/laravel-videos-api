<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $period = $this->faker->randomElement(['year', 'month', 'week', 'day']);

        $createdAt = $this->faker->dateTimeBetween("-1 $period");

        return [
            'title' => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->sentences(3, true),
            'channel_id' => Channel::query()->inRandomOrder()->first(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
