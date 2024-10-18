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
        Schema::create('tour_attribute_tour_attribute_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');

            $table->foreignId('tour_attribute_id')->constrained()->onDelete('cascade');

            $table->foreignId('tour_attribute_item_id')
                ->constrained('tour_attribute_items')
                ->onDelete('cascade')
                ->name('fk_tour_attr_item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_attribute_tour_attribute_item');
    }
};
