<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_receipt', function (Blueprint $table) {
            $table->id();
            $table->string('p_receipt_id')->unique();
            $table->date('date_created');
            $table->string('purchase_id');
            $table->foreign('purchase_id')->references('purchase_id')->on('materials_purchased');
            $table->json('item_list_received');
            $table->float('grand_total');
            $table->string('pr_status')->default('Draft');
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
        Schema::dropIfExists('purchase_receipt');
    }
}
