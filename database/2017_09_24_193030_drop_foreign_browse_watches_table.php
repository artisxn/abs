<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignBrowseWatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('browse_watches', function (Blueprint $table) {
            $table->dropForeign(['browse_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('browse_watches', function (Blueprint $table) {
            $table->foreign('browse_id')
                  ->references('id')
                  ->on('browses')
                  ->onDelete('cascade');
        });
    }
}
