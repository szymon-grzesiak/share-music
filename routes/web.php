<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::name('users.')->prefix('users')->group(function () {
        Route::get('', [UserController::class, 'index'])
            ->name('index')
            ->middleware(['permission:users.index']);
    });


    Route::name('logs.')->prefix('logs')->group(function () {
        Route::get('', [LogController::class, 'index'])
            ->name('index')
            ->middleware(['permission:users.index']);
    });
    Route::resource('genres', GenreController::class)->only([
        'index', 'create', 'edit'
    ]);


    Route::resource('albums', AlbumController::class)->only([
        'index', 'create', 'edit'
    ]);

    Route::resource('songs', SongController::class)->only([
        'index', 'create', 'edit'
    ]);

    Route::resource('playlists', PlaylistController::class)->only([
        'index', 'create', 'edit'
    ]);

    Route::get('/playlists/{playlist}/songs', [PlaylistController::class, 'songs'])
        ->name('playlists.songs')
        ->middleware(['permission:playlists.index']);
});


