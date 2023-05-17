<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    public function create(User $user)
    {
        return $user->hasVerifiedEmail();
    }
}
