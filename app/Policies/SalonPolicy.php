<?php

namespace App\Policies;

use App\User;
use App\Salon;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalonPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Salon $salon)
    {
        return $user->id === $salon->user_id;
    }

    public function view(User $user, Salon $salon)
    {
        return $user->id === $salon->user_id;
    }
}
