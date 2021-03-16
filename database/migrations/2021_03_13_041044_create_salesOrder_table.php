<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesOrder', function (Blueprint $table) {
            $table->id();
            #Foreign key customer id
            $table->integer('customer_id');
            $table->float('cost_price')->nullable();
            $table->string('sale_currency')->nullable();
            $table->string('sale_supply_method')->nullable();
            $table->integer('quantity');
            $table->string('stock_unit');
            
            $table->date('product_launch_date');
            $table->date('product_pulled_off_market');
            $table->date('date');

            
            $table->string('payment_mode');
            $table->float('initial_payment')->nullable();
            $table->float('payment_balance')->nullable();
            $table->json('payment_track')->nullable();
            $table->string('payment_status');
            $table->string('sales_status');

            #Foreign key Product Code
            $table->string('product_code');
            #Removed Sales id. Same function as table id
            $table->string('sales_unit');
            $table->string('installment_type')->nullable();
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
