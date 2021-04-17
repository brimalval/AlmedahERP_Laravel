<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaymentModeInPiLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_invoice_logs', function (Blueprint $table) {
            //
            $table->dropColumn('payment_mode');
        });
        Schema::table('purchase_invoice', function (Blueprint $table) {
            //
            $table->string('payment_mode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pi_logs', function (Blueprint $table) {
            //
        });
    }
}
