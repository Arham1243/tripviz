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
        Schema::dropIfExists('additional_items');
        Schema::dropIfExists('tours_additionals');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tours_additionals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('additional_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
