<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBindingToWorldItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('world_items', function (Blueprint $table) {
            $table->unsignedInteger('binding_id')->after('availability')->nullable();
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
            $table->dropColumn(['binding_id']);
        });
    }
}
