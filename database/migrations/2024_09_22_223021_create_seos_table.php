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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->morphs('seoable');
            $table->boolean('is_seo_index')->default(true);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_featured_image')->nullable();
            $table->string('fb_title')->nullable();
            $table->text('fb_description')->nullable();
            $table->text('fb_featured_image')->nullable();
            $table->string('tw_title')->nullable();
            $table->text('tw_description')->nullable();
            $table->string('tw_featured_image')->nullable();
            $table->text('schema')->nullable();
            $table->string('canonical')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
