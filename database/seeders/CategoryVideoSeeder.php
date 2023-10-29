<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = Video::query()->get();

        Category::get()->flatMap(
            fn (Category $category) => $category->videos()->saveMany($this->randomVideos($videos))
        );
    }

    private function randomVideos(Collection $videos): Collection
    {
        return $videos->random(mt_rand(1, $videos->count()));
    }
}
