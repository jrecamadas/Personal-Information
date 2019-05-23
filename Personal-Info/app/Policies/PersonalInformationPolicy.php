<?php

namespace App\Policies;

use App\Models\PersonalInformation;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalInformationPolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function view(User $user, Log $log)
    {
        return $this->isAllowed($user, 'logs', 'can_view');
    }

    /**
     * Determine whether the user can create logs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->isAllowed($user, 'logs', 'can_add');
    }

    /**
     * Determine whether the user can update the log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function update(User $user, Log $log)
    {
        return $this->isAllowed($user, 'logs', 'can_edit');
    }

    /**
     * Determine whether the user can delete the log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function delete(User $user, Log $log)
    {
        return $this->isAllowed($user, 'logs', 'can_delete');
    }

    /**
     * Determine whether the user can restore the log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function restore(User $user, Log $log)
    {
        return $this->isAllowed($user, 'logs', 'can_edit');
    }

    /**
     * Determine whether the user can permanently delete the log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function forceDelete(User $user, Log $log)
    {
        return $this->isAllowed($user, 'logs', 'can_delete');
    }
}