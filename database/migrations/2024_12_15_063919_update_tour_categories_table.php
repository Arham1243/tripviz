<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tour_categories', function (Blueprint $table) {
            // Drop the unnecessary columns
            $table->dropColumn([
                'tour_count_heading',
                'tour_count_image',
                'tour_count_btn_text',
                'tour_count_btn_link',
            ]);

            // Add the new column for section content
            $table->text('section_content')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tour_categories', function (Blueprint $table) {
            // Revert the changes in case of rollback
            $table->string('tour_count_heading')->nullable();
            $table->string('tour_count_image')->nullable();
            $table->string('tour_count_btn_text')->nullable();
            $table->string('tour_count_btn_link')->nullable();

            $table->dropColumn('section_content');
        });
    }
};
