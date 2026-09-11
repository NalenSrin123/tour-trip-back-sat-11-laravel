<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->string('booking_number', 50)->unique();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('tour_id')->index();
            $table->unsignedBigInteger('schedule_id')->index();
            $table->unsignedInteger('adult_count')->default(1);
            $table->unsignedInteger('child_count')->default(0);
            $table->decimal('total_price', 10, 2);
            $table->string('contact_name', 100);
            $table->string('contact_phone', 20);
            $table->text('special_request')->nullable();
            $table->string('booking_status', 50)->default('pending')->index();
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};