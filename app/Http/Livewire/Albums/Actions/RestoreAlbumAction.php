<?php

namespace App\Http\Livewire\Albums\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RestoreAlbumAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('albums.actions.restore');
    }

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = 'trash';

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('albums.dialogs.restore.title'),
            'description' => __('albums.dialogs.restore.description', [
                'name' => $model->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'restore',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ],
        ]);
    }

    public function renderIf($model, View $view)
    {
        return request()->user()->can('restore', $model);
    }
}
