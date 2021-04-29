<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePurchaseIdAndSalesIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_order', function($table) {
            $table->dropColumn('purchase_id');
            $table->bigIncrements('work_order_no');
            $table->string('mat_ordered_id')->nullable();
            $table->foreign('mat_ordered_id')->references('mat_ordered_id')->on('materials_ordered');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->string('purchase_id')->nullable();
        $table->foreign('purchase_id')->references('purchase_id')->on('materials_purchased');
        $table->dropColumn('work_order_no');
        $table->dropColumn('mat_ordered_id');
    }
}
