<?php

namespace App\Http\Livewire\Playlists;


use App\Models\Playlist;
use LaravelViews\Views\GridView;
use Illuminate\Database\Eloquent\Builder;

class PlaylistsGridView extends GridView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Playlist::class;

    public $maxCols = 3;

    public $cardComponent = 'livewire.playlists.grid-view-item';

    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
        'release_date'
    ];

    public function sortableBy()
    {
        return [
            'Name' => 'name',
        ];
    }

    protected $paginate = 5;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $query = Playlist::query()
            ->with(['user'])
            ->join('users', 'playlists.user_id', '=', 'users.id')
            ->select( 'users.name as user_name', 'playlists.*');


        if (request()->user()->can('manage', Playlist::class)) {
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
            'image' => $model->image,
            'user' => $model->user->name,
            ];
    }
}

