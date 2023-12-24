<?php

namespace App\Http\Livewire\Playlists\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;
use Livewire\Livewire;

class DeleteSongFromPlaylistAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = 'Usuń';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = 'minus-circle';

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        if (method_exists($view, 'deleteFromPlaylist')) {
            $view->deleteFromPlaylist($model->id);
        }
    }

//    public function renderIf($model, View $view)
//    {
//        // Ensure that this condition is true for the action to be rendered
////        return request()->user()->can('restore', $model);
//    }
}
