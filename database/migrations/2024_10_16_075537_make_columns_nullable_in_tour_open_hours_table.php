<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tour_open_hours', function (Blueprint $table) {
            $table->string('day')->nullable()->change();
            $table->time('open_time')->nullable()->change();
            $table->time('close_time')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('tour_open_hours', function (Blueprint $table) {
            $table->string('day')->nullable(false)->change();
            $table->time('open_time')->nullable(false)->change();
            $table->time('close_time')->nullable(false)->change();
        });
    }
};
