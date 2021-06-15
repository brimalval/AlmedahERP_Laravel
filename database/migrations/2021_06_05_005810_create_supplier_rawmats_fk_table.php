<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierRawmatsFkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_mats', function (Blueprint $table) {
            $table->string('supplier_id');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
            $table->string('item_code');
            $table->foreign('item_code')->references('item_code')->on('env_raw_materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_rawmats_fk');
    }
}
