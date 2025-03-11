<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employees;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the employees can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the employees can view the model.
     */
    public function view(User $user, Employees $model): bool
    {
        return true;
    }

    /**
     * Determine whether the employees can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the employees can update the model.
     */
    public function update(User $user, Employees $model): bool
    {
        return true;
    }

    /**
     * Determine whether the employees can delete the model.
     */
    public function delete(User $user, Employees $model): bool
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
     * Determine whether the employees can restore the model.
     */
    public function restore(User $user, Employees $model): bool
    {
        return false;
    }

    /**
     * Determine whether the employees can permanently delete the model.
     */
    public function forceDelete(User $user, Employees $model): bool
    {
        return false;
    }
}
