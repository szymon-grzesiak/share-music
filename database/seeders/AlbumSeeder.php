<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Album::factory()->count(50)->create();
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'spotify23.p.rapidapi.com',
            'X-RapidAPI-Key' => '34968fee8dmsh13a083a76c74fc3p1870b2jsn57c8dae9b6a0'
        ])->get('https://spotify23.p.rapidapi.com/albums/?ids=64LU4c1nfjz1t4VnGhagcg%2C1NAmidJlEaVgA3MpcPFYGq%2C4MwOuqjdK7OP1xaRPo83xT%2C6VgJZRUsCbR1NTnJWU85G4%2C3zXjR3y2dUWklKmmp6lEhy%2C6lqE05fiHWJVYYdMVJNj38%2C2cWBwpqMsDJC1ZUwz813lo');

        if ($response->successful()) {
            $data = $response->json();

            foreach ($data['albums'] as $albumData) {
                // Find or create the artist user
                $artistName = $albumData['artists'][0]['name']; // Assuming the first artist
                $artist = User::firstOrCreate(
                    ['name' => $artistName],
                    [
                        'email' => strtolower(str_replace(' ', '.', $artistName)) . '@localhost', // Generate a unique email
                        'email_verified_at' => Carbon::now(),
                        'password' => Hash::make('12345678'),
                    ]
                );

                Album::create([
                    'name' => $albumData['name'],
                    'album_cover' => $albumData['images'][0]['url'],
                    'release_date' => $albumData['release_date'],
                    'artist_id' => $artist->id,
                ]);
            }
        } else {
            throw new \Exception('Failed to retrieve data from API: ' . $response->status());
        }
    }
}
