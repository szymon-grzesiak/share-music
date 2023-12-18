<?php

namespace App\Http\Livewire\Songs\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\RestoreAction;

class RestoreSongAction extends RestoreAction
{
    /**
     * Tytuł okna dialogowego
     *
     * @return String
     */
    protected function dialogTitle(): String
    {
        return __('songs.dialogs.restore.title');
    }

    /**
     * Opis okna dialogowego
     *
     * @param Model $model
     * @return String
     */
    protected function dialogDescription(Model $model): String
    {
        return __('songs.dialogs.restore.description', [
            'name' => $model->name
        ]);
    }
}
