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
        Schema::table('tour_price_discounts', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_price_discounts', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->nullable(false)->change();
        });
    }
};
