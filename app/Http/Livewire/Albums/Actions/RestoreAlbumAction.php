<?php

namespace App\Http\Livewire\Albums\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\RestoreAction;

class RestoreAlbumAction extends RestoreAction
{
    /**
     * Tytuł okna dialogowego
     *
     * @return String
     */
    protected function dialogTitle(): String
    {
        return __('albums.dialogs.restore.title');
    }

    /**
     * Opis okna dialogowego
     *
     * @param Model $model
     * @return String
     */
    protected function dialogDescription(Model $model): String
    {
        return __('albums.dialogs.restore.description', [
            'name' => $model->name
        ]);
    }
}
