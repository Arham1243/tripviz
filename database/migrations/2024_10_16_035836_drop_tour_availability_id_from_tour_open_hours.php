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
        Schema::table('tour_open_hours', function (Blueprint $table) {
            $table->dropForeign(['tour_availability_id']);
            
            $table->dropColumn('tour_availability_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_open_hours', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_availability_id')->nullable();
            
            $table->foreign('tour_availability_id')->references('id')->on('tour_availabilities')->onDelete('cascade');
        });
    }
};
