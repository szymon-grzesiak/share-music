<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(640, 480, 'music', true),
            'user_id' => User::select('id')->orderByRaw('RAND()')->first()->id,
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
