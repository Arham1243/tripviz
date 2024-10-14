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
            $table->unsignedBigInteger('author_id')->nullable()->after('id'); 
            $table->boolean('is_featured')->default(0)->nullable()->after('author_id'); 
            $table->text('featured_state')->nullable()->after('is_featured'); 
            $table->string('ical_import_url')->nullable()->after('featured_state'); 
            $table->string('ical_export_url')->nullable()->after('ical_import_url'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['author_id', 'is_featured', 'featured_state', 'ical_import_url', 'ical_export_url']);
        });
    }
};
