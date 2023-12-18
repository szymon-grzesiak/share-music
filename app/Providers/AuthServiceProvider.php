<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use App\Policies\AlbumPolicy;
use App\Policies\GenrePolicy;
use App\Policies\PlaylistPolicy;
use App\Policies\SongPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Genre::class => GenrePolicy::class,
        Playlist::class => PlaylistPolicy::class,
        Song::class => SongPolicy::class,
        Album::class => AlbumPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
