<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the reservation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the reservation can view the model.
     */
    public function view(User $user, Reservation $model): bool
    {
        return true;
    }

    /**
     * Determine whether the reservation can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the reservation can update the model.
     */
    public function update(User $user, Reservation $model): bool
    {
        return true;
    }

    /**
     * Determine whether the reservation can delete the model.
     */
    public function delete(User $user, Reservation $model): bool
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
     * Determine whether the reservation can restore the model.
     */
    public function restore(User $user, Reservation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the reservation can permanently delete the model.
     */
    public function forceDelete(User $user, Reservation $model): bool
    {
        return false;
    }
}
