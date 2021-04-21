<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_payment');
            #Foreign Key
            $table->unsignedBigInteger('sales_id');
            $table->foreign('sales_id')->references('id')->on('salesOrder');
            $table->float('amount_paid');
            $table->string('customer_rep')->nullable();
            $table->string('payment_method');
            # Converted to string from json since mysql json returns bytes value
            $table->string('payment_description');
            $table->string('payment_status');
            $table->float('payment_balance');
            # Will only display when user chose cheque
            $table->string('cheque_no')->nullable();
            $table->string('account_no')->nullable();
            $table->string('account_name')->nullable();
            $table->date('post_date_cheque')->nullable();
            $table->string('bank_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_logs');
    }
}
