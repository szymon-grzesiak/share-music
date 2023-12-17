<?php

namespace App\Http\Livewire\Albums;

use App\Models\Album;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Albums\Actions\EditAlbumAction;
use App\Http\Livewire\Albums\Actions\RestoreAlbumAction;
use App\Http\Livewire\Albums\Actions\SoftDeletesAlbumAction;

class AlbumsTableView extends TableView
{
    use Actions;

    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
        'album_cover',
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
        return Album::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('albums.attributes.name'))->sortBy('name'),
            Header::title(__('albums.attributes.album_cover'))->sortBy('album_cover'),
            Header::title(__('albums.attributes.description'))->sortBy('description'),
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
        return [
            $model->name,
            $model->album_cover,
            $model->description,
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
