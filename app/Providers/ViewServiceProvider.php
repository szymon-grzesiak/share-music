<?php

namespace App\Providers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $playlistsQuery = Playlist::query();

            if (auth()->user()->hasRole('admin')) {
                $playlistsQuery->withTrashed();
            } else {
                $playlistsQuery->where('user_id', auth()->id());
            }

            $playlists = $playlistsQuery->get();

            $songs = Song::with('album', 'user')->get();

            $view->with('playlists', $playlists)
                ->with('songs', $songs);
        });
    }
}
