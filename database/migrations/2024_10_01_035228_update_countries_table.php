<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Begin transaction
        DB::beginTransaction();

        try {
            // Drop the foreign key constraint first
            Schema::table('countries', function (Blueprint $table) {
                $table->dropForeign(['continent_id']);
            });

            // Drop the old columns
            Schema::table('countries', function (Blueprint $table) {
                $table->dropColumn([
                    'short_desc',
                    'img_path',
                    'show_on_homepage',
                    'is_active',
                    'continent_id',
                ]);
            });

            // Add the new columns
            Schema::table('countries', function (Blueprint $table) {
                // Adding new columns before created_at and updated_at
                $table->text('content')->nullable()->after('name');
                $table->string('slug', 255)->nullable();
                $table->string('featured_image')->default('admin/assets/images/placeholder.png')->nullable()->after('content');
                $table->string('featured_image_alt_text')->nullable()->after('featured_image');
                $table->enum('status', ['publish', 'draft'])->default('draft')->after('featured_image_alt_text');
            });

            // Add soft deletes after the existing timestamps
            Schema::table('countries', function (Blueprint $table) {
                $table->softDeletes()->after('updated_at');
            });

            // Commit transaction
            DB::commit();
        } catch (\Exception $e) {

        }
    }

    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            // Recreate the foreign key if necessary
            $table->unsignedBigInteger('continent_id')->nullable();
            $table->foreign('continent_id')->references('id')->on('continents')->onDelete('set null');

            // Add back the old columns
            $table->string('short_desc')->nullable();
            $table->string('img_path')->nullable();
            $table->boolean('show_on_homepage')->default(false);
            $table->boolean('is_active')->default(true);

            // Drop the new columns
            $table->dropColumn([
                'content',
                'featured_image',
                'featured_image_alt_text',
                'status',
            ]);

            // Drop soft deletes
            $table->dropSoftDeletes();
        });
    }
};
