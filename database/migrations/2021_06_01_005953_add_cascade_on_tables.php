<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeOnTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('materials_purchased', function (Blueprint $table) {
            $table->string('purchase_id')->onDelete('cascade')->change();
        });

        Schema::table('purchase_receipt', function (Blueprint $table) {
            $table->string('p_receipt_id')->onDelete('cascade')->change();
        });

        Schema::table('purchase_invoice', function (Blueprint $table) {
            $table->string('p_invoice_id')->onDelete('cascade')->change();
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
