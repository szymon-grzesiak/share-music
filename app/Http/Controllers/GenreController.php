<?php

namespace App\Http\Controllers;

use App\Http\Repositories\GenreRepository;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
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
        $this->authorize('viewAny', Genre::class);
        return view(
            'genres.index'
        );
    }


    /**
     * Return list of resources
     *
     * @param Request $request
     * @return void
     */
    public function async(Request $request, GenreRepository $repository)
    {
        return $repository->select(
            $request->search,
            $request->selected
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Genre::class);

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
        $this->authorize('update', $genre);
        return view(
            'genres.form',
            [
                'genre' => $genre
            ]
        );
    }
    public function __toString()
    {
        return $this->name;
    }
}
