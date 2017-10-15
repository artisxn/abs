<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_sets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('item_asin', 10)->unique();
            $table->foreign('item_asin')
                  ->references('asin')
                  ->on('items')
                  ->onDelete('cascade');

            $table->json('image_sets');

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
        Schema::dropIfExists('image_sets');
    }
}
