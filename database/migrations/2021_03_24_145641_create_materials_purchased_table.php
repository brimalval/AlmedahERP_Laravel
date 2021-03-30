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
            $table->string('supp_quotation_id')->nullable();
            //change nullable and remove comment on line below
            //when integrating with suppliers quotation
            //$table->foreign('supp_quotation_id')->references('supp_quotation_id')->on('suppliers_quotation');
            $table->json('items_list_purchased');
            $table->date('purchase_date');
            $table->string('mp_status')->default('Pending');
            $table->float('total_cost', 10, 2);
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
