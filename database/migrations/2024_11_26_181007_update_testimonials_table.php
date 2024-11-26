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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['main_img_path', 'is_active']);

            $table->string('slug')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt_text')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();  // Enable soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('main_img_path');
            $table->boolean('is_active')->default(true);

            $table->dropColumn(['slug', 'featured_image', 'featured_image_alt_text', 'status']);
            $table->dropSoftDeletes();
        });
    }
};
