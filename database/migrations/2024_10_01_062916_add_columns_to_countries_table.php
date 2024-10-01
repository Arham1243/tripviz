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
        Schema::table('countries', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('content');
            $table->string('featured_image_alt_text')->nullable()->after('featured_image');
            $table->enum('status', ['publish', 'draft'])->default('draft')->after('featured_image_alt_text');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn(['featured_image', 'featured_image_alt_text', 'status', 'deleted_at']);
        });
    }
};
