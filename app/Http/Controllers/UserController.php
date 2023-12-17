<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        return view(
        // pierwsza część to nazwa szablonu, a druga część to plik
            'users.index',
        );
    }

    public function showArtists($artistId)
    {
        return User::query()->with('roles');

        return view('albums.songs');
    }
}
