<?php

namespace App\Http\Livewire\Songs\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\SoftDeletesAction;

class SoftDeletesSongAction extends SoftDeletesAction
{
    /**
     * Tytuł okna dialogowego
     *
     * @return String
     */
    protected function dialogTitle(): String
    {
        return __('songs.dialogs.soft_deletes.title');
    }

    /**
     * Opis okna dialogowego
     *
     * @param Model $model
     * @return String
     */
    protected function dialogDescription(Model $model): String
    {
        return __('songs.dialogs.soft_deletes.description', [
            'name' => $model->name
        ]);
    }
}
