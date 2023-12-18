<?php

namespace App\Http\Livewire\Songs;

use App\Http\Livewire\Albums\Actions\RestoreAlbumAction;
use App\Http\Livewire\Albums\Actions\SoftDeletesAlbumAction;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Songs\Actions\EditSongAction;
use App\Http\Livewire\Songs\Actions\RestoreSongAction;
use App\Http\Livewire\Songs\Actions\SoftDeletesSongAction;
use App\Http\Livewire\Songs\Filters\InputAlbumFilter;
use App\Http\Livewire\Songs\Filters\InputArtistFilter;
use App\Http\Livewire\Songs\Filters\InputGenreFilter;
use App\Http\Livewire\Traits\Restore;
use App\Http\Livewire\Traits\SoftDeletes;
use App\Models\Album;
use App\Models\Song;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use WireUi\Traits\Actions;

class SongsTableView extends TableView
{
    use Actions;
    use SoftDeletes;
    use Restore;

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
            ->with(['album', 'genres', 'user']);

        if (request()->user()->can('manage', Song::class)) {
            $query->withTrashed();
        }

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
            Header::title('Nazwa albumu')->sortBy('albums.name'),
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
            $model->album ? '<span class="hover:underline"><a href="albums?sortOrder=asc&search=' . $model->album->name . '">' . $model->album->name . '</a></span>' : 'No Album',
            'title' => '<span >' . $model->title . '</span>',
            'duration' => $formattedDuration,
            'genres' => $model->genres->implode('name', ', '),
            $model->user ? '<span class="hover:underline"><a href="albums?sortOrder=asc&filters[input-user-filter]=' . $model->user->name . '">' . $model->user->name . '</a></span>' : 'No User'
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
            new EditSongAction(
                'songs.edit',
                __('songs.actions.edit')
            ),
            new SoftDeletesSongAction(),
            new RestoreSongAction(),
        ];
    }
    protected function softDeletesNotificationDescription(Model $model)
    {
        return __('songs.messages.successes.destroyed', [
            'name' => $model->name
        ]);
    }

    protected function restoreNotificationDescription(Model $model)
    {
        return __('songs.messages.successes.restored', [
            'name' => $model->name
        ]);
    }
}
