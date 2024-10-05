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
        Schema::table('tour_reviews', function (Blueprint $table) {
            $table->dropColumn('is_active');

            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending')->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tour_reviews', function (Blueprint $table) {
            // Re-add the 'is_active' column (for rollback purposes)
            $table->boolean('is_active')->default(0);

            // Remove the 'status' column
            $table->dropColumn('status');
        });
    }
};
