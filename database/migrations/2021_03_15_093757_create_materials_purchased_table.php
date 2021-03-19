<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsPurchasedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_purchased', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_id')->unique();
            # No table to reference for supplier_id
            $table->string('supplier_id');
            $table->string('item_code');
            $table->foreign('item_code')->references('item_code')->on('env_raw_materials');
            # No table yet to reference uom_id
            $table->string('uom_id');
            $table->integer('quantity_received')->default(0);
            $table->float('percentage_received')->default(0);
            $table->date('purchase_date');
            # No table yet for req_quotation_id
            $table->integer('req_quotation_id');
            $table->string('mp_status');
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
        Schema::dropIfExists('materials_purchased');
    }
}
