<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        if(Schema::hasColumn('work_order', 'work_order_no')) {
            Schema::table('work_order', function(Blueprint $table) {
                $table->dropColumn('work_order_no');
            });
        }
        Schema::table('work_order', function(Blueprint $table) {
            $table->dropForeign(['purchase_id']);
            $table->dropColumn('purchase_id');
            $table->bigIncrements('work_order_no');
            $table->string('mat_ordered_id')->nullable();
            $table->foreign('mat_ordered_id')->references('mat_ordered_id')->on('materials_ordered')->change();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_order', function(Blueprint $table){
            $table->string('purchase_id')->nullable();
            $table->foreign('purchase_id')->references('purchase_id')->on('materials_purchased');
            //$table->dropForeign(['work_order_no']);
            $table->dropColumn('work_order_no');
            $table->dropForeign(['mat_ordered_id']);
            $table->dropColumn('mat_ordered_id');
        });
    }
}
