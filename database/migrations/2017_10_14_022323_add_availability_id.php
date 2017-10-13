<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailabilityId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->unsignedInteger('availability_id')->nullable()->after('availability');
            $table->foreign('availability_id')->references('id')->on('availabilities');
        });

        Schema::table('world_items', function (Blueprint $table) {
            $table->unsignedInteger('availability_id')->nullable()->after('availability');
            $table->foreign('availability_id')->references('id')->on('availabilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropForeign(['availability_id']);
            $table->dropColumn('availability_id');
        });

        Schema::table('world_items', function (Blueprint $table) {
            $table->dropForeign(['availability_id']);
            $table->dropColumn('availability_id');
        });
    }
}
