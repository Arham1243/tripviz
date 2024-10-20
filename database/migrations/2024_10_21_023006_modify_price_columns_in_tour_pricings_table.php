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
        Schema::table('tour_pricings', function (Blueprint $table) {
            $table->decimal('original_price', 20, 2)->nullable()->change();
            $table->decimal('discount_price', 20, 2)->nullable()->change();
            $table->decimal('promo_price', 20, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_pricings', function (Blueprint $table) {
            $table->decimal('original_price', 10, 2)->change();
            $table->decimal('discount_price', 10, 2)->change();
            $table->decimal('promo_price', 10, 2)->change();
        });
    }
};
