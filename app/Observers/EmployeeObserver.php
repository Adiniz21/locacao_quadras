<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{

    protected function syncRoles(Employee $employee): void
    {
        // sempre manter 'client' + o cargo (manager/referee/cleaner/staff)
        $roles = ['client'];
        if (!empty($employee->position)) {
            $roles[] = $employee->position;
        }

        if ($employee->user) {
            $employee->user->syncRoles($roles);
        }
    }

    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        $this->syncRoles($employee);
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        $this->syncRoles($employee);
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        //
    }
}
