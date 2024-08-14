<?php

namespace App\Policies;

use App\Models\User;
use App\Utils\Utils;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function isAdmin(User $user): bool
    {
        return $user->role === Utils::ROLE_ADMIN;
    }

    public function isBusinessOwner(User $user): bool
    {
        return $user->role === Utils::ROLE_BUSINESS_OWNER;
    }

    public function isEmployee(User $user): bool
    {
        return $user->role === Utils::ROLE_EMPLOYEE;
    }

}
