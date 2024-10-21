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
        Schema::create('tour_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->string('date_range')->nullable();
            $table->boolean('available_for_booking')->default(false);
            $table->integer('max_guest')->nullable();
            $table->integer('min_adult')->nullable();
            $table->integer('max_adult')->nullable();
            $table->decimal('adult_price', 20, 2)->nullable();
            $table->integer('min_child')->nullable();
            $table->integer('max_child')->nullable();
            $table->decimal('child_price', 20, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_availabilities');
    }
};
