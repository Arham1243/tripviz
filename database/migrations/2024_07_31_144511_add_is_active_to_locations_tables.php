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
        Schema::table('locations_tables', function (Blueprint $table) {
               Schema::table('continents', function (Blueprint $table) {
            $table->boolean('is_active')->default(1)->after('name');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->boolean('is_active')->default(1)->after('name');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->boolean('is_active')->default(1)->after('name');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations_tables', function (Blueprint $table) {
             Schema::table('continents', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
        });
    }
};
