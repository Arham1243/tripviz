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
        Schema::create('tour_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('short_desc')->nullable();
            $table->integer('estimated_read_time')->nullable();
            $table->text('long_desc')->nullable();
            $table->string('img_path')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_stories');
    }
};
