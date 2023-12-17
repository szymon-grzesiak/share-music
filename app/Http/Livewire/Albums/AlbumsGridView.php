<?php

namespace App\Http\Livewire\Albums;

use App\Http\Livewire\Albums\Filters\InputUserFilter;
use App\Models\Album;
use LaravelViews\Views\GridView;
use Illuminate\Database\Eloquent\Builder;

class AlbumsGridView extends GridView
{
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
            'album_cover' => $model->album_cover,
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
}

