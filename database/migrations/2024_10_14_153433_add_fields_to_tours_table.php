<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('title');
            $table->foreign('category_id')->references('id')->on('tour_categories')->onDelete('set null');
            $table->text('badge_icon_class')->nullable();
            $table->text('badge_name')->nullable();
            $table->json('inclusions')->nullable(); 
            $table->json('exclusions')->nullable(); 
            $table->json('features')->nullable(); 
            $table->json('details')->nullable(); 
            $table->string('banner_image')->nullable();
            $table->string('banner_image_alt_text')->nullable();
            $table->string('banner_type')->nullable();
            $table->string('video_link')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id', 
                'badge_icon_class', 
                'badge_name', 
                'inclusions', 
                'exclusions', 
                'details', 
                'banner_image', 
                'banner_image_alt_text',
                'video_link',
                'banner_type'
            ]);
        });
    }
};
