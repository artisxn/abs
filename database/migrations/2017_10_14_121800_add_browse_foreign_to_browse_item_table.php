<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Model\Browse;

class AddBrowseForeignToBrowseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('browse_item', function (Blueprint $table) {
            DB::table('browse_item')
              ->whereNotIn('browse_id', Browse::pluck('id'))
              ->delete();

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
        Schema::table('browse_item', function (Blueprint $table) {
            $table->dropForeign(['browse_item_browse_id_foreign']);
        });
    }
}
