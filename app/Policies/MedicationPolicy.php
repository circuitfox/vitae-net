<?php

namespace App\Policies;

use App\User;
use App\Medication;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * An instructor or admin can create new medications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can update models.
     *
     * An instructor or admin can update medications.
     *
     * @param  \App\User  $user
     * @param  \App\Medication  $medication
     * @return mixed
     */
    public function update(User $user, Medication $medication)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can delete models.
     *
     * An instructor or admin can delete medications.
     *
     * @param  \App\User  $user
     * @param  \App\Medication  $medication
     * @return mixed
     */
    public function delete(User $user, Medication $medication)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }
}
