<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStocksTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('stock_transfer');
        Schema::create('stock_transfer', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id');
            $table->foreign('tracking_id')->references('tracking_id')->on('stock_moves');
            $table->date('move_date');
            $table->json('item_code');
            $table->foreignId('source_station')->nullable()->constrained('stations');
            $table->foreignId('target_station')->nullable()->constrained('stations'); 
            $table->string('transfer_status'); 
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
        //
    }
}
