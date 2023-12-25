<?php

namespace App\Policies;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class PlaylistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('playlists.index');
    }

    public function view(User $user, Playlist $playlist)
    {
        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole && $user->hasRole($adminRole->name)) {
            return true; // Administratorzy mają dostęp do wszystkich playlistów
        }

        return $user->id === $playlist->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('playlists.manage');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Playlist $playlist)
    {
        // Admin może edytować wszystkie piosenki
        if ($user->hasRole('admin')) {
            return true;
        }
        return $playlist->deleted_at === null && $user->id === $playlist->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Playlist $playlist)
    {
        // Admin może usuwać wszystkie piosenki
        if ($user->hasRole('admin')) {
            return true;
        }

        return $playlist->deleted_at === null && $user->id === $playlist->user_id;

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Playlist $playlist)
    {
        return $playlist->deleted_at !== null && $user->id === $playlist->user_id;

    }
}
