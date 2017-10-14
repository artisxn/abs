<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Model\Item;

class AddForeignToBrowseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('browse_item', function (Blueprint $table) {
            $table->string('item_asin', 10)->change();

            DB::table('browse_item')
              ->whereNotIn('item_asin', Item::pluck('asin'))
              ->delete();

            $table->foreign('item_asin')
                  ->references('asin')
                  ->on('items')
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
            $table->dropForeign(['browse_item_item_asin_foreign']);
        });
    }
}
