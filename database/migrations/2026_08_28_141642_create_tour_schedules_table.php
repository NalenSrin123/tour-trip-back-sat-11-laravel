<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_schedules', function (Blueprint $table) {
            $table->id('tour_id'); // Primary Key
            
            // Foreign Keys (Inferred from the diagram's relationship lines and ID suffixes)
            $table->unsignedBigInteger('guide_id'); // Represents the GUIDE relationship to User
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('destination_id');
            
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('duration');
            $table->text('included_services')->nullable();
            $table->text('excluded_services')->nullable();
            $table->decimal('rating_avg', 3, 2)->default(0.00);
            
            $table->timestamps();

            // Establishing the foreign key constraint to the users table
            $table->foreign('guide_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_schedules');
    }
};