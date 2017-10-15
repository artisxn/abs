<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_summaries', function (Blueprint $table) {
            $table->increments('id');

            $table->string('item_asin', 10)->unique();
            $table->foreign('item_asin')
                  ->references('asin')
                  ->on('items')
                  ->onDelete('cascade');

            $table->json('offer_summary');

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
        Schema::dropIfExists('offer_summaries');
    }
}
