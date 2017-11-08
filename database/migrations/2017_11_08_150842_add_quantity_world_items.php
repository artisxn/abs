<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuantityWorldItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('world_items', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->default(0)->after('total_used');
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
            $table->dropColumn('quantity');
        });
    }
}
