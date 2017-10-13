<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrowseWorldItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('browse_world_item', function (Blueprint $table) {
            $table->unsignedBigInteger('browse_id')->index();
            $table->foreign('browse_id')->references('id')->on('browses')->onDelete('cascade');
            $table->unsignedBigInteger('world_item_id')->index();
            $table->foreign('world_item_id')->references('id')->on('world_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('browse_world_item');
    }
}
