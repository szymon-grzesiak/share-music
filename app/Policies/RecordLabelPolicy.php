<?php

namespace App\Policies;

use App\Models\RecordLabel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordLabelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('record_labels.index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('record_labels.manage');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecordLabel  $record_label
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RecordLabel $record_label)
    {
        return $record_label->deleted_at === null
            && $user->can('record_labels.manage');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecordLabel  $record_label
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RecordLabel $record_label)
    {
        return $record_label->deleted_at === null
            && $user->can('record_labels.manage');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecordLabel  $record_label
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RecordLabel $record_label)
    {
        return $record_label->deleted_at !== null
            && $user->can('record_labels.manage');
    }
}
