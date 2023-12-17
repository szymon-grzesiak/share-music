<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
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

    public function async(Request $request, UserRepository $repository)
    {
        return $repository->select(
            $request->search,
            $request->selected
        );
    }
}
