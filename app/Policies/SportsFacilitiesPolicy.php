<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SportsFacilities;
use Illuminate\Auth\Access\HandlesAuthorization;

class SportsFacilitiesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the sportsFacilities can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the sportsFacilities can view the model.
     */
    public function view(User $user, SportsFacilities $model): bool
    {
        return true;
    }

    /**
     * Determine whether the sportsFacilities can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the sportsFacilities can update the model.
     */
    public function update(User $user, SportsFacilities $model): bool
    {
        return true;
    }

    /**
     * Determine whether the sportsFacilities can delete the model.
     */
    public function delete(User $user, SportsFacilities $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the sportsFacilities can restore the model.
     */
    public function restore(User $user, SportsFacilities $model): bool
    {
        return false;
    }

    /**
     * Determine whether the sportsFacilities can permanently delete the model.
     */
    public function forceDelete(User $user, SportsFacilities $model): bool
    {
        return false;
    }
}
