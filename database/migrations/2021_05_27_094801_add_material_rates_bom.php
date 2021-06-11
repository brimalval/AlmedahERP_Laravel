<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaterialRatesBom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('bom_bill_of_materials', function(Blueprint $table){
            $table->dropForeign(['purchase_id']);
            $table->dropColumn('purchase_id');
        });
        Schema::table('bom_bill_of_materials', function(Blueprint $table){
            $table->json('raw_materials_rate');
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
