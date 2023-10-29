<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           UserSeeder::class,
           ChannelSeeder::class,
           PlaylistSeeder::class,
           CategorySeeder::class,
           VideoSeeder::class,
           CategoryVideoSeeder::class,
           PlaylistVideoSeeder::class
        ]);
    }
}
