<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // Primary Key specified in diagram
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('role')->default('customer'); 
            $table->string('status')->default('active');
            $table->string('Profile_img')->nullable();
            $table->timestamps(); // Automatically creates 'created_at' and 'updated_at'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};