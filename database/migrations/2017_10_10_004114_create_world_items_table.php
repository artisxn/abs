<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorldItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('world_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asin', 10)->index();
            $table->string('ean', 13)->index()->nullable();
            $table->string('country', 2)->index();

            $table->string('title')->nullable();
            $table->unsignedInteger('rank')->nullable();

            $table->unsignedInteger('lowest_new_price')->nullable();

            $table->unsignedInteger('lowest_used_price')->nullable();

            $table->unsignedInteger('total_new')->nullable();

            $table->unsignedInteger('total_used')->nullable();

            $table->string('availability')->nullable();

            $table->text('editorial_review')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('world_items');
    }
}
