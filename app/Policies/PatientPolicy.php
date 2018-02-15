<?php

namespace App\Policies;

use App\Patient;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * An admin or instructor can create new patients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * An instructor or admin can update patients.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, Patient $model)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * An instructor or admin can delete patients.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, Patient $model)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }
}
