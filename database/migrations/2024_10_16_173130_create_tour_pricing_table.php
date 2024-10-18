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
        Schema::create('tour_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('price_type')->nullable();
            $table->string('person_type')->nullable();
            $table->string('person_description')->nullable();
            $table->integer('min_person')->nullable();
            $table->integer('max_person')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('car_price', 10, 2)->nullable();
            $table->time('time')->nullable();
            $table->decimal('water_price', 10, 2)->nullable();
            $table->string('promo_title')->nullable();
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('promo_price', 10, 2)->nullable();
            $table->date('offer_expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_pricings');
    }
};
