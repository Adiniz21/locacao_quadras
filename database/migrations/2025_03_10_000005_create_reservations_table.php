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
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sports_facilities_id');
            $table->unsignedBigInteger('user_id');
            $table->date('reservation_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('total_price');
            $table->enum('payment_status', ['pending', 'confirmed', 'paid', 'cancelled'])
                ->default('confirmed');
            $table->enum('recurrence', ['none', 'daily', 'weekly', 'biweekly', 'monthly']);
            $table->boolean('notification_sent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
