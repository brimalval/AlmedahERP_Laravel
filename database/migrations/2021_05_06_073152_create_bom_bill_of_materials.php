<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBomBillOfMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'bom_bill_of_materials',
            function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('bom_id')->unique();
                $table->string('product_code');
                $table->foreign('product_code')->references('product_code')->on('man_products');
                $table->string('routing_id');
                $table->string('purchase_id');
                $table->foreign('purchase_id')->references('purchase_id')->on('materials_purchased');
                $table->string('bom_name');
                $table->float('raw_material_cost', 10, 2);
                $table->float('total_cost', 10, 2);
                $table->boolean('is_active')->nullable();
                $table->boolean('is_default')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bom_bill_of_materials');
    }
}
