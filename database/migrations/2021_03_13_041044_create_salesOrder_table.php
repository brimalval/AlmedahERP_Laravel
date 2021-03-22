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
            # Also the sales id
            $table->id();

            #Foreign key
            $table->integer('customer_id');

            $table->float('cost_price')->nullable();
            $table->string('sale_currency')->nullable();
            $table->string('sale_supply_method');
            $table->date('transaction_date');
            $table->string('payment_mode');

            $table->float('initial_payment')->nullable();
            $table->string('installment_type')->nullable();

            $table->string('sales_status');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesOrder');
    }
}
