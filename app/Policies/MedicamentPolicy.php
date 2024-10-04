<?php

namespace App\Policies;

use App\Models\Medicament;
use App\Models\User;

class MedicamentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Medicament $medicament): bool
    {
        return $user->id === $medicament->user_id;
    }

    public function update(User $user, Medicament $medicament): bool
    {
        return $user->id === $medicament->user_id;
    }
}
