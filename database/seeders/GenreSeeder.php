<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Rock', 'Pop', 'Jazz', 'Classical', 'Blues', 'Reggae', 'Hip-Hop', 'Country',
            'Electronic', 'Folk', 'Heavy Metal', 'Punk', 'R&B', 'Soul', 'Funk', 'Disco',
            'House', 'Techno', 'Trance', 'Ambient', 'Gospel', 'Opera', 'Ska', 'Grime',
            'Dubstep', 'Drum and Bass', 'Industrial', 'Grunge', 'K-Pop', 'J-Pop', 'Latin',
            'Reggaeton', 'Afrobeat', 'Fado', 'Bossa Nova', 'Flamenco', 'Celtic', 'Country Rock',
            'Psychedelic Rock', 'Progressive Rock', 'Hard Rock', 'Bluegrass', 'Glam Rock',
            'Folk Rock', 'Punk Rock', 'Indie Rock', 'Alternative Rock', 'Shoegaze', 'Lo-fi'
        ];

        foreach ($genres as $genreName) {
            Genre::create(['name' => $genreName]);
        }
    }
}
