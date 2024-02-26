<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function isAdmin(User $user)
    {
        return $user->userable_type == "App\Models\Administrador";
    }
}
