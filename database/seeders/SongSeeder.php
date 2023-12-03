<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all();
        Song::factory()
            ->count(100)
            ->create()
            ->each(function ($song) use ($genres) {
                $song->genres()->attach(
                    $genres->random(rand(1, 2))->pluck('id')->toArray()
                );
            });
    }
}
