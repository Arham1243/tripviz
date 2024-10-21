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
        Schema::table('tour_availabilities', function (Blueprint $table) {
            $table->dropColumn('date_range');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_availabilities', function (Blueprint $table) {
            $table->string('date_range')->nullable();
            $table->dropColumn(['start_date', 'end_date']);
        });
    }
};
