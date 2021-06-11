<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTableAddSsMethodReorderLvlQty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('man_products', function (Blueprint $table) {
            $table->string('sale_supply_method');
            $table->double('reorder_level', 8, 2)->nullable();
            $table->double('reorder_qty', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('man_products', function (Blueprint $table) {
            $table->dropColumn('reorder_qty');
            $table->dropColumn('reorder_level');
            $table->dropColumn('sale_supply_method');
        });
    }
}
