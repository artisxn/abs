<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormattedPriceWorldItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('world_items', function (Blueprint $table) {
            $table->string('lowest_new_formatted_price')->nullable()->after('lowest_new_price');
            $table->string('lowest_used_formatted_price')->nullable()->after('lowest_used_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('world_items', function (Blueprint $table) {
            $table->dropColumn(['lowest_new_formatted_price', 'lowest_used_formatted_price']);
        });
    }
}
