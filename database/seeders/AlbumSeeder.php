<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use App\Singletons\SpotifyApiSingleton;
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
        $data = SpotifyApiSingleton::getInstance()->getResponse();


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
    }
}
