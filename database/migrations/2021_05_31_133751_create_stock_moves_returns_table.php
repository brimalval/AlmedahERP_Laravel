<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('stock_return');
        Schema::create('stock_return', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id');
            $table->foreign('tracking_id')->references('tracking_id')->on('stock_transfer');
            $table->date('return_date');
            $table->json('item_code');
            $table->string('return_status'); 
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
        Schema::dropIfExists('stock_moves_returns');
    }
}
