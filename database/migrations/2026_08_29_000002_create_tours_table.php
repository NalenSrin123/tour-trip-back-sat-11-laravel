<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id('tour_id');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                  ->references('category_id')
                  ->on('tour_categories')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('destination_id')->nullable();

            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('duration')->nullable();
            $table->text('included_services')->nullable();
            $table->text('excluded_services')->nullable();
            $table->decimal('rating_avg', 3, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};