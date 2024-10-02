<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt_text')->nullable();
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->json('top_featured_tour_ids')->nullable();
            $table->json('bottom_featured_tour_ids')->nullable();
            $table->json('recommended_tour_ids')->nullable();
            $table->string('tour_count_heading')->nullable();
            $table->string('tour_count_image')->nullable();
            $table->string('tour_count_btn_link')->nullable();
            $table->json('tour_reviews_ids')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_categories');
    }
};
