<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Playlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Playlist::query()
            ->with('channel.videos')
            ->each(fn(Playlist $playlist) => $playlist->videos()->saveMany($this->randomVideoFrom($playlist->channel)));
    }

    private function randomVideoFrom(Channel $channel): Collection
        {
            return $channel->videos->whenEmpty(
                fn() => collect(),
                fn(Collection $videos) => $videos->random(mt_rand(1, $channel->videos->count()))
            );
        }
}
