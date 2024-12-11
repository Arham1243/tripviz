<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tour_categories', function (Blueprint $table) {
            $table->string('tour_count_btn_text')->nullable()->before('tour_count_btn_link');
        });
    }

    public function down()
    {
        Schema::table('tour_categories', function (Blueprint $table) {
            $table->dropColumn('tour_count_btn_text');
        });
    }
};
