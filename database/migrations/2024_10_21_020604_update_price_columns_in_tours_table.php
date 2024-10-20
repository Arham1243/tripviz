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
            $table->decimal('service_fee_price', 20, 2)->nullable()->change();
            $table->decimal('sale_price', 20, 2)->nullable()->change();
            $table->decimal('regular_price', 20, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->decimal('service_fee_price', 10, 2)->change();
            $table->decimal('sale_price', 10, 2)->change();
            $table->decimal('regular_price', 10, 2)->change();
        });
    }
};
