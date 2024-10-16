<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_faqs', function (Blueprint $table) {
            // Drop the existing foreign key constraint (tours_faqs_tour_id_foreign)
            $table->dropForeign('tours_faqs_tour_id_foreign');

            // Add a new foreign key with onDelete('cascade')
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_faqs', function (Blueprint $table) {
            // Drop the foreign key with 'cascade' deletion rule
            $table->dropForeign(['tour_id']);

            // Re-add the old foreign key with onDelete('set null')
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('set null');
        });
    }
};
