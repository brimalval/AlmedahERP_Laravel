<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_group', function (Blueprint $table) {
            $table->id();
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
        Schema::table('supplier_group', function(Blueprint $table) {
            $table->dropForeign(['item_code']);
            $table->dropColumn('item_code');
            $table->dropForeign(['supplier_id']);
            $table->dropColumn('supplier_id');
        });

        Schema::dropIfExists('supplier_group');
    }
}
