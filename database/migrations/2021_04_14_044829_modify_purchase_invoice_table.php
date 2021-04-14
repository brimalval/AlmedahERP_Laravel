<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\DBAL\TimestampType;

class ModifyPurchaseInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_invoice', function (Blueprint $table) {
            $table->dropColumn('due_date_of_payment');
            $table->dropColumn('mode_payment');
            $table->renameColumn('paid_amount', 'grand_total');
            $table->float('total_amount_paid');
            $table->float('payment_balance');
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
