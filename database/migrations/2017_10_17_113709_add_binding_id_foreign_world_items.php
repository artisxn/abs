<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBindingIdForeignWorldItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('world_items', function (Blueprint $table) {
            $table->foreign('binding_id')->references('id')->on('bindings');
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
            $table->dropForeign(['binding_id']);
        });
    }
}
