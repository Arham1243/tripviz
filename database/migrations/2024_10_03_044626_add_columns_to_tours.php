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
            // Remove specified columns
            $table->dropColumn([
                'img_path',
                'show_on_homepage',
                'short_desc',
                'for_adult_price',
                'for_child_price',
                'for_car_price',
                'price_type',
                'highlights',
                'is_active',
            ]);

            // Add new columns
            $table->text('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt_text')->nullable();
            $table->enum('status', ['publish', 'draft'])->default('draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            // Add back the removed columns
            $table->string('img_path')->nullable();
            $table->boolean('show_on_homepage')->default(0);
            $table->text('short_desc')->nullable();
            $table->decimal('for_adult_price', 10, 2)->nullable();
            $table->decimal('for_child_price', 10, 2)->nullable();
            $table->decimal('for_car_price', 10, 2)->nullable();
            $table->string('price_type')->nullable();
            $table->text('highlights')->nullable();
            $table->boolean('is_active')->default(1);

            // Drop newly added columns
            $table->dropColumn(['content', 'featured_image', 'featured_image_alt_text', 'status']);
        });
    }
};
