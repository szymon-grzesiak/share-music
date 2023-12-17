<?php

namespace App\Http\Livewire\Albums;

use App\Http\Livewire\Albums\Actions\EditAlbumAction;
use App\Http\Livewire\Albums\Actions\RestoreAlbumAction;
use App\Http\Livewire\Albums\Actions\SoftDeletesAlbumAction;
use App\Http\Livewire\Albums\Filters\InputUserFilter;
use App\Http\Livewire\Traits\Restore;
use App\Http\Livewire\Traits\SoftDeletes;
use App\Models\Album;
use Illuminate\Database\Eloquent\Model;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use Illuminate\Database\Eloquent\Builder;

class AlbumsGridView extends GridView
{

    use Actions;
    use SoftDeletes;
    use Restore;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = Album::class;

    public $maxCols = 3;

    public $cardComponent = 'livewire.albums.grid-view-item';

    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
        'release_date'
    ];

    protected $paginate = 6;


    public function sortableBy()
    {
        return [
            'Album Name' => 'name',
            'Release Data' => 'release_date'
        ];
    }

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $query = Album::query();
        if (request()->user()->can('manage', Album::class)) {
            $query->withTrashed();
        }
        return $query;
    }

    /**
     * Sets the data to every card on the view
     *
     * @param $model Current model for each card
     */
    public function card($model)
    {
        return [
            'name' => $model->name,
            'album_cover' => str_contains($model->album_cover, 'http') ?  $model->album_cover : $model->imageUrl(),
            'artist' => $model->user->name,
            'release_date' => $model->release_date,
            'created_at' => $model->created_at,
            ];
    }

    /**
     * Set filters
     */
    protected function filters()
    {
        return [
            new InputUserFilter,
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        if (request()->user()->can('manage', Album::class)) {
            return [
                new EditAlbumAction('albums.edit', __('translation.actions.edit')),
                new SoftDeletesAlbumAction(),
                new RestoreAlbumAction(),
            ];
        }
        return null;
    }
    protected function softDeletesNotificationDescription(Model $model)
    {
        return __('albums.messages.successes.destroyed', [
            'name' => $model->name
        ]);
    }

    protected function restoreNotificationDescription(Model $model)
    {
        return __('albums.messages.successes.restored', [
            'name' => $model->name
        ]);
    }
}

