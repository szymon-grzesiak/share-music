<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use App\Singletons\SpotifyApiSingleton;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = SpotifyApiSingleton::getInstance()->getResponse();

        $genres = Genre::all();

        foreach ($data['albums'] as $albumData) {
            $album = Album::where('name', $albumData['name'])->first();
            $artist = User::where('name', $albumData['artists'][0]['name'])->first();

            if ($album && $artist) {
                foreach ($albumData['tracks']['items'] as $track) {
                    $song = Song::firstOrCreate([
                        'title' => $track['name'],
                        'duration' => $track['duration_ms'],
                        'album_id' => $album->id,
                        'artist_id' => $artist->id,
                    ]);

                    if ($song->wasRecentlyCreated) {
                        $song->genres()->sync(
                            $genres->random(rand(1, 1))->pluck('id')->toArray()
                        );
                    }
                }
            }
        }
    }
}
