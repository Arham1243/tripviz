<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('tour_media');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // You can define this if you want to reverse the migration (optional)
        Schema::create('tour_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->string('media_url');
            $table->timestamps();
        });
    }
};
