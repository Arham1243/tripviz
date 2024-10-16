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
            $table->unsignedBigInteger('tour_id')->nullable()->after('id');

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_open_hours', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['tour_id']);

            // Drop the 'tour_id' column
            $table->dropColumn('tour_id');
        });
    }
};
