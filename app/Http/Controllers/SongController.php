<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Song::class);
        return view(
            'songs.index'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Song::class);

        return view(
            'songs.form'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        $this->authorize('update', $song);
        return view(
            'songs.form',
            [
                'song' => $song
            ]
        );
    }
    public function __toString()
    {
        return $this->name;
    }
}
