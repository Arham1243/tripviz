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
        Schema::table('sections', function (Blueprint $table) {
            $table->string('heading')->nullable()->after('is_active');
            $table->text('short_desc')->nullable()->after('heading');
            $table->string('bg_img')->nullable()->after('short_desc');
            $table->string('subHeading')->nullable()->after('bg_img');
            $table->string('sale_name')->nullable()->after('subHeading');
            $table->string('android_app_link')->nullable()->after('sale_name');
            $table->string('ios_app_link')->nullable()->after('android_app_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            //
        });
    }
};
