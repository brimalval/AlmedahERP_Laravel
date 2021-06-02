<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsListPurchased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_list_purchased', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('purchase_id');
            $table->foreign('purchase_id')->references('purchase_id')->on('materials_purchased');
            $table->string('item_code');
            $table->float('qty');
            $table->string('supplier_id');
            $table->date('required_date');
            $table->float('rate');
            $table->float('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials_list_purchased');
    }
}
