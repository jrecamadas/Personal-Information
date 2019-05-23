<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Services\PolicyService;
use Auth;

class BasePolicy
{
    use HandlesAuthorization;

    public function isAllowed($user, $resource, $action) {
        $policy = new PolicyService($user->id, $resource, $action);
        return $policy->verifyAccess();
    }
}