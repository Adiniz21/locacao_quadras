<?php

namespace Database\Seeders;

// database/seeders/RolesAndPermissionsSeeder.php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Permissões (exemplos — ajuste às suas telas/ações)
        $perms = [
            'users.view',
            'users.manage',
            'venues.view',
            'venues.manage',
            'facilities.view',
            'facilities.manage',
            'reservations.view.own',
            'reservations.view.any',
            'reservations.create',
            'reservations.manage',
            'payments.view',
            'payments.manage',
            'maintenances.view',
            'maintenances.manage',
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Roles
        $cliente  = Role::firstOrCreate(['name' => 'client']);
        $manager  = Role::firstOrCreate(['name' => 'manager']);
        $referee  = Role::firstOrCreate(['name' => 'referee']);
        $cleaner  = Role::firstOrCreate(['name' => 'cleaner']);
        $staff    = Role::firstOrCreate(['name' => 'staff']);

        // Regras por role (exemplo)
        $cliente->givePermissionTo([
            'facilities.view',
            'reservations.create',
            'reservations.view.own',
            'payments.view',
        ]);

        $manager->givePermissionTo(Permission::all()); // gerente vê tudo

        $referee->givePermissionTo([
            'facilities.view',
            'reservations.view.any',
            'maintenances.view',
        ]);

        $cleaner->givePermissionTo([
            'facilities.view',
            'maintenances.view',
        ]);

        $staff->givePermissionTo([
            'facilities.view',
            'reservations.view.any',
            'payments.view',
        ]);
    }
}
