<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = Song::all();
        Playlist::factory()
            ->count(100)
            ->create()
            ->each(function ($playlist) use ($songs) {
                $playlist->songs()->attach(
                    $songs->random(rand(1, 5))->pluck('id')->toArray()
                );
            });
    }
}
