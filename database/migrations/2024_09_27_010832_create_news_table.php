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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('feature_image_alt_text')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('news_categories')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
