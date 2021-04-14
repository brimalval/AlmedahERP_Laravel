<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoiceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoice_logs', function (Blueprint $table) {
            $table->id();
            $table->string('pi_logs_id')->unique();
            $table->string('p_invoice_id');
            $table->foreign('p_invoice_id')->references('p_invoice_id')->on('purchase_invoice');
            $table->date('date_of_payment');
            $table->string('payment_mode');
            $table->string('payment_method');
            $table->string('payment_description');
            $table->float('amount_paid', 8, 2);
            $table->integer('account_no')->nullable();
            $table->integer('cheque_no')->nullable();
            //nullable for now
            //remove nullable property of employee id when integrating with
            //employee module
            $table->string('employee_id')->nullable();
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
        Schema::dropIfExists('purchase_invoice_logs');
    }
}
