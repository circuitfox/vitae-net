<?php

namespace App\Policies;

use App\User;
use App\Lab;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create labs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can update the lab.
     *
     * @param  \App\User  $user
     * @param  \App\Lab  $lab
     * @return mixed
     */
    public function update(User $user, Lab $lab)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can delete the lab.
     *
     * @param  \App\User  $user
     * @param  \App\Lab  $lab
     * @return mixed
     */
    public function delete(User $user, Lab $lab)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }
}
