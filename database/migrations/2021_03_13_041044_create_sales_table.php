<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            #Foreign key customer id
            $table->integer('customer_id');
            $table->integer('cost_price');
            $table->string('sale_supply_method');
            $table->integer('quantity');
            $table->string('stock_unit');
            
            $table->date('product_launch_date');
            $table->date('product_pulled_off_market');
            $table->date('date');
            # Null in database schema wtf
            $table->tinyInteger ('prototype');
            $table->tinyInteger ('unrenewed');
            ####################################
            $table->string('payment_mode');
            $table->float('initial_payment');
            $table->float('payment_balance');
            $table->string('payment_track');
            $table->string('payment_status');
            $table->string('sales_status');
            $table->string('version');
            $table->string('description');
            #Foreign key Product Code
            $table->string('product_code');
            #Removed Sales id. Same function as table id
            $table->string('sales_unit');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
