<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sports_facilities', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Relacionamentos
            $table->foreignId('venue_id')->constrained('venues')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();

            // Dados da unidade (quadra)
            $table->string('name');
            // Se quiser manter um "tipo" fixo, use enum; se preferir livre, troque para ->string('sport')->nullable()
            $table->enum('type', ['futsal','volleyball','soccer','badminton','basketball','tennis'])->nullable();

            $table->integer('capacity')->nullable();           // opcional
            $table->decimal('hourly_price', 8, 2)->default(0); // preço/hora
            $table->boolean('availability')->default(true);    // disponível para reserva?

            // Localização (opcional)
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->timestamps();

            // Índices úteis
            $table->index('venue_id');
            $table->index('owner_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sports_facilities');
    }
};
