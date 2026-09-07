<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_galleries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tour_id')
                ->constrained('tours', 'tour_id')
                ->cascadeOnDelete();

            $table->string('image_url');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_galleries');
    }
};