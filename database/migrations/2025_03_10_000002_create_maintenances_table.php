<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            // se você adiciona a FK depois, deixe só o unsignedBigInteger aqui:
            $table->unsignedBigInteger('sports_facilities_id'); // FK virá na add_foreigns_...
            $table->string('description');
            $table->date('scheduled_date')->nullable();   // <--- ESTA É A COLUNA QUE FALTA
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])
                ->default('scheduled');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
