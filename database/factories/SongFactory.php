<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\RecordLabel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
           'album_id' => Album::select('id')->orderByRaw('RAND()')->first()->id,
            'record_labels_id' => RecordLabel::select('id')->orderByRaw('RAND()')->first()->id,
            'artist_id' => User::select('id')->orderByRaw('RAND()')->first()->id,
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
