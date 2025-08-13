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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id'); // FK adicionada depois na add_foreigns_...
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('status', ['pending','paid','failed','refunded'])->default('pending');
            $table->string('method', 20)->nullable();  // <- AQUI
            $table->dateTime('paid_at')->nullable();   // <- E AQUI
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
