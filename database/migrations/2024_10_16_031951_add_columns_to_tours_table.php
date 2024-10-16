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
        Schema::table('tours', function (Blueprint $table) {
            $table->boolean('is_fixed_date')->default(0);
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->date('last_booking_date')->nullable();
        $table->boolean('is_open_hours')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn([
                'is_fixed_date', 
                'start_date', 
                'end_date', 
                'last_booking_date', 
                'is_open_hours'
            ]);
        });
    }
};
