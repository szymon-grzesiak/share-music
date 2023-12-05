<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Playlist::class);
        return view(
            'playlists.index'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Playlist::class);

        return view(
            'playlists.form'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        return view(
            'playlists.form',
            [
                'playlist' => $playlist
            ]
        );
    }
    public function __toString()
    {
        return $this->name;
    }
}
