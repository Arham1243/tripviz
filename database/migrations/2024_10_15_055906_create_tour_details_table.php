<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tour_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->json('items')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_details');
    }
};
