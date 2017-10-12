<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriorityToWatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('watches', function (Blueprint $table) {
            $table->unsignedTinyInteger('priority')->after('asin_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('watches', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
}
