<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssessmentPolicy
{
    use HandlesAuthorization;

    /*
     * Determine whether the user can create or update models.
     *
     * Any user can create or update assessments
     *
     * @param  \App\User  $user
     * @param  \App\Assessment  $assessment
     * @return mixed
     */
    public function update(User $user, Assessment $assessment)
    {
        return true;
    }
}
