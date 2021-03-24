<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRqSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rq_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('req_quotation_id');
            $table->foreign('req_quotation_id')->references('req_quotation_id')->on('materials_quotations');
            $table->string('supplier_id');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
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
        Schema::dropIfExists('rq_suppliers');
    }
}
