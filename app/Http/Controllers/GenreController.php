<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'genres.index'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'genres.form'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view(
            'genres.form',
            [
                'genre' => $genre
            ]
        );
    }
}
