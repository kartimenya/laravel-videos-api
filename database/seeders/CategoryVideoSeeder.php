<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $categoryIds = Category::query()->pluck('id');
        $videoIds = Video::query()->pluck('id');

        $categoryVideos = $categoryIds->flatMap(function (int $id) use ($videoIds) {
            $randomVideoIds = $videoIds->random(mt_rand(1, count($videoIds)));


            return $randomVideoIds->map(function (int $videoId) use ($id) {
                return [
                    'category_id' => $id,
                    'video_id' => $videoId,
                ];
            });
        });

        DB::table('category_video')->insert($categoryVideos->all());
    }
}
