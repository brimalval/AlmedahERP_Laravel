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
            $table->string('supp_quotation_id');
            $table->json('items_list_purchased');
            $table->date('purchase_date');
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
