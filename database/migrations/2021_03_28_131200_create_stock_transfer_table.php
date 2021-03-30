<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transfer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracking_id')->constrained('stock_moves');
            $table->date('move_date');
            $table->foreignId('item_code')->constrained('env_raw_materials');
            $table->float('qty_transferred');
            $table->foreignId('source_station')->constrained('stations');
            $table->foreignId('target_station')->constrained('stations');
            $table->boolean('consumable'); 
            $table->string('item_condition'); 
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
        Schema::dropIfExists('stock_transfer');
    }
}
