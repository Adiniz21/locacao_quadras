<?php

namespace Database\Seeders;

// database/seeders/EmployeeTypesSeeder.php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class EmployeeTypesSeeder extends Seeder
{
    public function run(): void
    {
        // Slugs padrão dos tipos de empregado
        $slugs = ['manager', 'referee', 'cleaner', 'staff'];

        // Monta os registros usando o id do role (guard 'web');
        // se o role não existir ainda, role_id fica null (sem erro).
        $rows = collect($slugs)->map(function (string $slug) {
            $roleId = Role::where('name', $slug)
                ->where('guard_name', 'web')
                ->value('id');

            return [
                'slug'       => $slug,
                'name'       => ucfirst($slug),
                'role_id'    => $roleId,      // pode ser null se o role não existir
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->all();

        // upsert: cria se não existir (pela chave 'slug') e,
        // se já existir, atualiza apenas name, role_id e updated_at
        DB::table('employee_types')->upsert(
            $rows,
            ['slug'],                       // chave única
            ['name', 'role_id', 'updated_at'] // campos a atualizar no conflito
        );
    }
}
