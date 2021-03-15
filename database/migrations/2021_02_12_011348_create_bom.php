<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_bill_of_materials', function (Blueprint $table) {
            $table->id();
            //remove nullable once we know where customer_id goes in BOM
            $table->integer('customer_id')->nullable();
            $table->string('product_code');
            $table->integer('bom_quantity');
            $table->string('unit');
            //remove nullable when we know how to get rate_per_quantity
            $table->float('rate_per_quantity', 10, 2)->nullable();
            $table->string('bom_status')->default('Draft');
            $table->string('currency');
            $table->integer('is_active');
            $table->integer('is_default');
            $table->integer('allow_alternative_item');
            $table->integer('set_rate_assembly_item');
            $table->float('total_cost', 10, 2); 
            $table->foreign('product_code')->references('product_code')->on('man_products');
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
        Schema::dropIfExists('bom_bill_of_materials');
    }
}
