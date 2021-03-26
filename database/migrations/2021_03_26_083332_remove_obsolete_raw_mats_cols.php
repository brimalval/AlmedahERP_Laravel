<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveObsoleteRawMatsCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('env_raw_materials', function (Blueprint $table) {
            $table->dropColumn('unit_price');
            // Total amount will be replaced by rm_quantity
            $table->dropColumn('total_amount');
            $table->dropColumn('total_amount_min');
            $table->float('rm_quantity');
            $table->float('stock_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('env_raw_materials', function (Blueprint $table) {
            $table->dropColumn('stock_quantity');
            $table->dropColumn('rm_quantity');
            $table->float('total_amount');
            $table->float('total_amount_min')->default(0);
            $table->float('unit_price');
        });
    }
}
