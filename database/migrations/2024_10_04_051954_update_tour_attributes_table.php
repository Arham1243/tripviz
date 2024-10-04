<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tour_attributes', function (Blueprint $table) {
            // Remove specified columns
            $table->dropForeign(['tour_id']);
            $table->dropColumn(['tour_id', 'title', 'icon_class', 'is_active']);

            // Add new columns
            $table->string('name')->nullable();
            $table->json('items')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Add soft deletes
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('tour_attributes', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('icon_class')->nullable();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }
};
