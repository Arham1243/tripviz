<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tour_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_category_id')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('tour_categories', function (Blueprint $table) {
            $table->dropColumn('parent_category_id');
        });
    }
};
