<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            // Drop columns
            $table->dropColumn(['img_path', 'short_desc', 'show_on_homepage', 'is_active']);

            // Add new columns before 'created_at' and 'updated_at'
            $table->text('content')->nullable()->before('created_at');
            $table->string('featured_image')->nullable()->before('created_at');
            $table->string('featured_image_alt_text')->nullable()->before('created_at');
            $table->enum('status', ['publish', 'draft'])->default('draft')->before('created_at');

            // Soft deletes (if not already in the model)
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            // Restore dropped columns
            $table->string('img_path')->nullable();
            $table->text('short_desc')->nullable();
            $table->boolean('show_on_homepage')->default(false);
            $table->boolean('is_active')->default(true);

            // Drop added columns
            $table->dropColumn(['content', 'featured_image', 'featured_image_alt_text', 'status', 'deleted_at']);
        });
    }
};
