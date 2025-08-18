<?php
// database/migrations/2025_08_18_000000_create_employee_types_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // 1) Tabela de tipos de empregado (sem seed aqui)
        Schema::create('employee_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Ex.: Manager, Referee, ...
            $table->string('slug')->unique(); // Ex.: manager, referee, ...
            $table->unsignedBigInteger('role_id')->nullable(); // (opcional) integra com Spatie
            $table->timestamps();

            // comente esta linha se NÃO usar spatie/permission
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
        });

        // 2) Adicionar a FK em employees (mantém 'position' por enquanto)
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('employee_type_id')
                  ->nullable()
                  ->after('user_id')
                  ->constrained('employee_types')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });
    }

    public function down(): void {
        // Remover FK e coluna
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['employee_type_id']);
            $table->dropColumn('employee_type_id');
        });

        Schema::dropIfExists('employee_types');
    }
};
