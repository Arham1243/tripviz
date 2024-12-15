<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('banner_image')->nullable()->after('featured_image');
            $table->string('banner_image_alt_text')->nullable()->after('banner_image');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('banner_image')->nullable()->after('featured_image');
            $table->string('banner_image_alt_text')->nullable()->after('banner_image');
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn(['banner_image', 'banner_image_alt_text']);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn(['banner_image', 'banner_image_alt_text']);
        });
    }
};
