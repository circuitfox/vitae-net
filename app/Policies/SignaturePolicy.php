<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SignaturePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can index models.
     *
     * An instructor or admin can index signatures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }

    /**
     * Determine whether the user can create models.
     *
     * Any user can create new signatures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can destroy models.
     *
     * An instructor or admin can destroy signatures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        return in_array($user->role, ['instructor', 'admin']);
    }
}
