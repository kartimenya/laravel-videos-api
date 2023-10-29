<?php

namespace Database\Factories;

use App\Enums\Period;
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
        return [
            'title' => ucfirst(fake()->words(mt_rand(1, 2), true)),
            'description' => fake()->sentences(mt_rand(1, 3), true),
            'channel_id' => Channel::query()->inRandomOrder()->first(),
        ];
    }

    public function last(Period $period) : Factory
    {
        return $this->state(function () use ($period) {
            $createdAt = fake()->dateTimeBetween("-1 $period->value");

            return [
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        });
    }
}
