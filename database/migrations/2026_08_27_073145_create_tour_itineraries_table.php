<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tour_itineraries_tb', function (Blueprint $table) {
            $table->id('tour_itineraries_id');

            $table->unsignedBigInteger('tour_id');

            $table->unsignedInteger('day_number');

            $table->string('title');

            $table->text('description')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('tour_id')
                ->references('tour_id')
                ->on('tours_tb')
                ->cascadeOnDelete();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tour_itineraries_tb');
    }
};
