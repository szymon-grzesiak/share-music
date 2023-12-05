<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
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

        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'spotify23.p.rapidapi.com',
            'X-RapidAPI-Key' => '34968fee8dmsh13a083a76c74fc3p1870b2jsn57c8dae9b6a0'
        ])->get('https://spotify23.p.rapidapi.com/albums/?ids=64LU4c1nfjz1t4VnGhagcg%2C1NAmidJlEaVgA3MpcPFYGq%2C4MwOuqjdK7OP1xaRPo83xT%2C6VgJZRUsCbR1NTnJWU85G4%2C3zXjR3y2dUWklKmmp6lEhy%2C6lqE05fiHWJVYYdMVJNj38%2C2cWBwpqMsDJC1ZUwz813lo');

        $data = $response->json();
        // Fetch all genres from your database
        $genres = Genre::all();

        foreach ($data['albums'] as $albumData) {
            // Find the album and artist in your database
            $album = Album::where('name', $albumData['name'])->first();
            $artist = User::where('name', $albumData['artists'][0]['name'])->first(); // Assuming the first artist

            if ($album && $artist) {
                foreach ($albumData['tracks']['items'] as $track) {
                    // Create a song record
                    $song = Song::create([
                        'title' => $track['name'],
                        'album_id' => $album->id,
                        'artist_id' => $artist->id,
                        // 'record_label_id' => // Assign record label if available
                    ]);

                    // Attach 1 or 2 random genres to the song
                    $song->genres()->attach(
                        $genres->random(rand(1, 1))->pluck('id')->toArray()
                    );
                }
            }
        }
    }
}
