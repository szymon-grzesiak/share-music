<?php

namespace App\Http\Livewire\Albums\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\SoftDeletesAction;

class SoftDeletesAlbumAction extends SoftDeletesAction
{
    /**
     * Tytuł okna dialogowego
     *
     * @return String
     */
    protected function dialogTitle(): String
    {
        return __('albums.dialogs.soft_deletes.title');
    }

    /**
     * Opis okna dialogowego
     *
     * @param Model $model
     * @return String
     */
    protected function dialogDescription(Model $model): String
    {
        return __('albums.dialogs.soft_deletes.description', [
            'name' => $model->name
        ]);
    }
}
