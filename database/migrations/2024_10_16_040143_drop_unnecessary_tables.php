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
        Schema::dropIfExists('tour_availabilities');
        Schema::dropIfExists('continents');
        Schema::dropIfExists('tour_exclusions');
        Schema::dropIfExists('tour_inclusions');
        Schema::dropIfExists('tour_itineraries');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tour_availabilities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('continents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('tour_exclusions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('tour_inclusions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('tour_itineraries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
