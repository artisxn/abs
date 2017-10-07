<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->text('detail_url')->nullable()->after('title');
            $table->string('large_image')->nullable()->after('title');
            $table->longText('image_sets')->nullable()->after('title');
            $table->text('offers')->nullable()->after('title');
            $table->text('offer_summary')->nullable()->after('title');
            $table->text('attributes')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn([
                'detail_url',
                'large_image',
                'image_sets',
                'offers',
                'offer_summary',
                'attributes',
            ]);
        });
    }
}
