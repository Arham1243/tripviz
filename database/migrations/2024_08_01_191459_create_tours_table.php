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
       Schema::create('tours', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->text('short_desc')->nullable();
        $table->decimal('rating', 2, 1)->nullable();
        $table->string('img_path')->nullable();
        $table->decimal('for_adult_price', 8, 2)->nullable();
        $table->decimal('for_child_price', 8, 2)->nullable();
        $table->decimal('for_car_price', 8, 2)->nullable();
        $table->enum('price_type', ['per_person', 'per_car'])->nullable(); // Add price_type column
        $table->boolean('is_active')->default(1);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
