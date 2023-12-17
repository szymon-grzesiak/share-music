<?php

namespace App\Http\Livewire\Albums;

use App\Http\Livewire\Songs\Filters\InputAlbumFilter;
use App\Http\Livewire\Songs\Filters\InputArtistFilter;
use App\Http\Livewire\Songs\Filters\InputGenreFilter;
use App\Models\Album;
use App\Models\Song;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Albums\Actions\EditAlbumAction;
use App\Http\Livewire\Albums\Actions\RestoreAlbumAction;
use App\Http\Livewire\Albums\Actions\SoftDeletesAlbumAction;

class SpecificAlbumTableView extends TableView
{
    use Actions;

    public $albumId;


    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'title',
        'duration',
        'genres.name',
        'user.name',
        'album.name'
    ];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $query = Song::query()
            ->with(['album', 'genres', 'user'])
            ->join('users', 'songs.artist_id', '=', 'users.id')
            ->join('genre_song', 'songs.id', '=', 'genre_song.song_id')
            ->join('genres', 'genre_song.genre_id', '=', 'genres.id')
            ->join('albums', 'songs.album_id', '=', 'albums.id')
            ->select('songs.*', 'users.name as user_name', 'genres.name as genre_name', 'albums.name as album_name', 'albums.album_cover as album_cover', 'albums.id as album_id')
            ->where('albums.id', '=', $this->albumId);

        return $query;
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('albums.attributes.album_cover')),
            Header::title(__('songs.attributes.title'))->sortBy('songs.title'),
            Header::title('Czas trwania')->sortBy('songs.duration'),
            Header::title('Gatunek')->sortBy('genres.name'),
            Header::title(__('users.attributes.name'))->sortBy('users.name'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $seconds = floor($model->duration / 1000);
        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;

        $formattedDuration = sprintf('%02d:%02d', $minutes, $seconds);

        return [
            $model->album ? '<img class="w-14 h-14 mx-auto" src="' . $model->album->album_cover . '" alt="Album Cover" />' : 'No Cover',
            $model->title => '<span class="text-red-400">'.$model->title.'</span>',
            $model->duration => $formattedDuration,
            $model->genres->implode('name', ', '),
            $model->user->name
        ];
    }

    /**
     * Set filters
     */
    protected function filters()
    {
        return [
            new SoftDeletedFilter,
            new InputGenreFilter,
            new InputAlbumFilter,
            new InputArtistFilter
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        return [
            new EditAlbumAction(
                'albums.edit',
                __('albums.actions.edit')
            ),
            new SoftDeletesAlbumAction(),
            new RestoreAlbumAction(),
        ];
    }

    public function softDeletes(int $id)
    {
        $album = Album::find($id);
        $album->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('albums.messages.successes.destroyed', [
                'name' => $album->name
            ])
        );
    }

    public function restore(int $id)
    {
        $album = Album::withTrashed()->find($id);
        $album->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('albums.messages.successes.restored', [
                'name' => $album->name
            ])
        );
    }
}
