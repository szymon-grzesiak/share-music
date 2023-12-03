<?php

namespace App\Http\Livewire\Songs;

use App\Http\Livewire\Songs\Actions\EditSongAction;
use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Albums\Actions\EditAlbumAction;
use App\Http\Livewire\Albums\Actions\RestoreAlbumAction;
use App\Http\Livewire\Albums\Actions\SoftDeletesAlbumAction;

class SongsTableView extends TableView
{
    use Actions;

    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'title',
        'album_cover',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $query = Song::query()
            ->with(['album', 'genres', 'record_label', 'user']);
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
            Header::title(__('songs.attributes.title'))->sortBy('title'),
            Header::title(__('albums.attributes.album_cover')),
            Header::title('Gatunek')->sortBy('name'),
            Header::title('Wytwornia Muzyczna')->sortBy('name'),
            Header::title(__('users.attributes.name'))->sortBy('name'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        // Assuming each song has an associated user

        return [
            $model->title,
            optional($model->album)->album_cover, // Use optional() in case album is null
            $model->genres->implode('name', ', '), // Implode the genre names
            optional($model->record_label)->name, // Use optional() in case record_label is null
            $model->user->name,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    /**
     * Set filters
     */
    protected function filters()
    {
        return [
            new SoftDeletedFilter,
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        return [
            new EditSongAction(
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
