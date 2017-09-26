<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemBrowseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('browse_item', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('item_asin')->index();
            $table->unsignedBigInteger('browse_id')->index();

            //                        $table->foreign('browse_id')
            //                              ->references('id')
            //                              ->on('browses')
            //                              ->onDelete('cascade');
            //
            //                        $table->foreign('item_asin')
            //                              ->references('asin')
            //                              ->on('items')
            //                              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('browse_item');
    }
}
