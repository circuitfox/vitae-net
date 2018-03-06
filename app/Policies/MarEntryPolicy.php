<?php

namespace App\Policies;

use App\User;
use App\MarEntry;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarEntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * An instructor or admin can create new MAR entries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can create models.
     *
     * An instructor or admin can update MAR entries.
     *
     * @param  \App\User  $user
     * @param  \App\Medication  $medication
     * @return mixed
     */
    public function update(User $user, MarEntry $marEntry)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }
}
