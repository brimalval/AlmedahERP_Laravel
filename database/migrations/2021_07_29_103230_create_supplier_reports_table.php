<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_reports', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('supp_quotation_id');
            $table->string('supplier_id');
            $table->string('item_code');
            $table->float('rate');
            $table->date('date_created');
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
        Schema::dropIfExists('supplier_reports');
    }
}
