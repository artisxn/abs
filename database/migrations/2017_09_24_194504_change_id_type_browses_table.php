<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdTypeBrowsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('browse_watches', function (Blueprint $table) {
            $table->unsignedBigInteger('browse_id')->change();
        });

        Schema::table('browses', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });

        Schema::table('browse_watches', function (Blueprint $table) {
            $table->foreign('browse_id')
                  ->references('id')
                  ->on('browses')
                  ->onDelete('cascade');
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
            $table->dropForeign(['browse_id']);
        });

        Schema::table('browses', function (Blueprint $table) {
            $table->unsignedInteger('id')->change();
        });

        Schema::table('browse_watches', function (Blueprint $table) {
            $table->unsignedInteger('browse_id')->change();
        });
    }
}
