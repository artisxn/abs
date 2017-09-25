<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->unsignedInteger('total_used')->nullable()->after('rank');

            $table->unsignedInteger('total_new')->nullable()->after('rank');

            $table->unsignedInteger('lowest_used_price')->nullable()->after('rank');

            $table->unsignedInteger('lowest_new_price')->nullable()->after('rank');

            $table->string('availability')->nullable()->after('rank')->comment('商品の発送可能時期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropColumn([
                'lowest_new_price',
                'lowest_used_price',
                'availability',
                'total_new',
                'total_used',
            ]);
        });
    }
}
