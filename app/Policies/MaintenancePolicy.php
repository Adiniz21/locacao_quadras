<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Maintenance;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintenancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the maintenance can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the maintenance can view the model.
     */
    public function view(User $user, Maintenance $model): bool
    {
        return true;
    }

    /**
     * Determine whether the maintenance can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the maintenance can update the model.
     */
    public function update(User $user, Maintenance $model): bool
    {
        return true;
    }

    /**
     * Determine whether the maintenance can delete the model.
     */
    public function delete(User $user, Maintenance $model): bool
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
     * Determine whether the maintenance can restore the model.
     */
    public function restore(User $user, Maintenance $model): bool
    {
        return false;
    }

    /**
     * Determine whether the maintenance can permanently delete the model.
     */
    public function forceDelete(User $user, Maintenance $model): bool
    {
        return false;
    }
}
