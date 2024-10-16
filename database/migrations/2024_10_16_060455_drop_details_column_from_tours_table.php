<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDetailsColumnFromToursTable extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('details');
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->json('details')->nullable();
        });
    }
}
