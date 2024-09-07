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
        Schema::create('additional_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->unsignedBigInteger('additional_id')->nullable();
            $table->string('title')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('additional_id')->references('id')->on('tours_additionals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_items');
    }
};
