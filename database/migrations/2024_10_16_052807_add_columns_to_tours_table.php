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
            $table->decimal('regular_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->tinyInteger('is_person_type_enabled')->default(0);
            $table->tinyInteger('is_extra_price_enabled')->default(0);
            $table->string('price_type')->nullable();
            $table->decimal('service_fee_price', 10, 2)->nullable();
            $table->string('phone_country_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->tinyInteger('show_phone')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn([
                'regular_price',
                'sale_price',
                'is_person_type_enabled',
                'price_type',
                'service_fee_price',
                'phone_number',
                'phone_country_code',
                'show_phone',
            ]);
        });
    }
};
