<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payments_id');
            $table->foreignId('booking_id')
                  ->constrained('bookings', 'booking_id')
                  ->onDelete('cascade');
            $table->string('payment_method', 50);
            $table->decimal('amount', 10, 2);
            $table->string('payment_status', 50)->default('pending')->index();
            $table->string('transaction_id', 100)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};