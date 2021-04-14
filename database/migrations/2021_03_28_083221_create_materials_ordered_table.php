<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsOrderedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_ordered', function (Blueprint $table) {
            $table->id();
            $table->string('mat_ordered_id')->unique();
            $table->string('p_receipt_id');
            $table->foreign('p_receipt_id')->references('p_receipt_id')->on('purchase_receipt');
            $table->json('items_list_received');
            $table->string('mo_status')->default('Pending');
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
        Schema::dropIfExists('materials_ordered');
    }
}
