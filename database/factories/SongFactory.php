<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        // Get an artist role
        $artistRole = Role::where('name', 'artist')->first();

        // Assuming that 'artist' role exists, find users with that role
        $artistUsers = $artistRole ? $artistRole->users()->pluck('id') : collect();

        // Ensure there is at least one user with 'artist' role
        if ($artistUsers->isEmpty()) {
            throw new \Exception('No users with the artist role found.');
        }

        return [
            'title' => $this->faker->word,
            'album_id' => Album::select('id')->orderByRaw('RAND()')->first()->id,
            'artist_id' => $artistUsers->random(),
            'created_at' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 week'),
            'updated_at' => $this->faker->dateTimeBetween(
                '- 4 weeks',
                '- 1 week'),
            'deleted_at' => rand(0, 10) === 0 ? $this->faker->dateTimeBetween(
                '- 1 week',
                '+ 2 weeks') : null
        ];
    }
}
