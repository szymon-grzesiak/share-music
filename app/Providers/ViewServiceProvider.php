<?php

namespace App\Providers;

use App\Models\Playlist;
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
            $query = Playlist::with(['user']);

            if (auth()->check() && auth()->user()->can('playlists.manage')) {
                $query->withTrashed();
            } else {
                $query->where('user_id', auth()->id());
            }

            $view->with('playlists', $query->get());
        });
    }
}
