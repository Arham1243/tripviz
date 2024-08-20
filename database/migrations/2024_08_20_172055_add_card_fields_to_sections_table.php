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
            $table->string('card_title_2')->nullable();
            $table->string('card_title_1')->nullable();
            $table->string('card_title_3')->nullable();
            $table->text('card_para_1')->nullable();
            $table->text('card_para_2')->nullable();
            $table->text('card_para_3')->nullable();
            $table->string('card_bg_1')->nullable();
            $table->string('card_bg_2')->nullable();
            $table->string('card_bg_3')->nullable();
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
