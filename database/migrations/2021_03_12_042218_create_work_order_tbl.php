<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrderTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            //foreign key needed
            $table->string('purchase_id');
            $table->integer('materials_qty');
            $table->string('product_code');
            $table->foreign('product_code')->references('product_code')->on('man_products');
            //foreign key needed
            $table->string('sales_id');
            $table->string('work_order_status');
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
        Schema::dropIfExists('work_order_tbl');
    }
}
