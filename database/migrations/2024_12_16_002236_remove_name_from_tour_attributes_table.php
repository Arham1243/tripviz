<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tour_attributes', function (Blueprint $table) {
            $table->dropColumn('items');
        });
    }

    public function down()
    {
        Schema::table('tour_attributes', function (Blueprint $table) {
            $table->string('items')->nullable()->after('id');
        });
    }
};
