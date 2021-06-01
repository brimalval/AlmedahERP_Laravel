<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppendForeignMaterialsList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('materials_list_purchased', function (Blueprint $table){
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
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
        //
    }
}
