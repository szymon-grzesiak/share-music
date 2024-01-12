<?php

namespace App\Http\Livewire\Playlists;


use App\Http\Livewire\Albums\Actions\EditAlbumAction;
use App\Http\Livewire\Albums\Actions\RestoreAlbumAction;
use App\Http\Livewire\Albums\Actions\SoftDeletesAlbumAction;
use App\Http\Livewire\Playlists\Actions\EditPlaylistAction;
use App\Http\Livewire\Playlists\Actions\RestorePlaylistAction;
use App\Http\Livewire\Playlists\Actions\SoftDeletesPlaylistAction;
use App\Http\Livewire\Traits\Restore;
use App\Http\Livewire\Traits\SoftDeletes;
use App\Models\Album;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Views\GridView;
use Illuminate\Database\Eloquent\Builder;
use WireUi\Traits\Actions;

class PlaylistsGridView extends GridView
{

    use Actions;
    use SoftDeletes;
    use Restore;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = Playlist::class;

    public $maxCols = 5;

    public $cardComponent = 'livewire.playlists.grid-view-item';

    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
        'user.name'
    ];

    public function sortableBy()
    {
        return [
            'Name' => 'name',
        ];
    }

    protected $paginate = 10;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {

        $user = Auth::user()->id;
        $query = Playlist::query()->where('user_id', $user);

        if (request()->user()->hasRole('admin')) {
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
            'description' => $model->description,
            'image' => str_contains($model->image, 'http') ?  $model->image : $model->imageUrl(),
            'user' => $model->user->name,
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        return [
            new EditPlaylistAction('playlist.edit', __('translation.actions.edit')),
            new SoftDeletesPlaylistAction(
                __('playlists.actions.destroy')
            ),
            new RestorePlaylistAction(
                __('playlists.actions.restore')
            ),
        ];
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

