<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            // Add new columns
            $table->decimal('for_adult_price', 8, 2)->nullable()->after('short_desc');
            $table->decimal('for_child_price', 8, 2)->nullable()->after('for_adult_price');
            $table->decimal('for_car_price', 8, 2)->nullable()->after('for_child_price');
            $table->enum('price_type', ['per_person', 'per_car'])->nullable()->after('for_car_price');

            // Drop the old column
            $table->dropColumn('price');
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            // Re-add the dropped column
            $table->decimal('price', 8, 2)->nullable()->after('short_desc');

            // Drop the new columns
            $table->dropColumn(['for_adult_price', 'for_child_price', 'for_car_price', 'price_type']);
        });
    }
};
