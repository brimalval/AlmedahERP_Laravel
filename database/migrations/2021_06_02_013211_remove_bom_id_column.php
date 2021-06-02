<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBomIdColumn extends Migration
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
            $table->dropUnique('bom_bill_of_materials_bom_id_unique');
            $table->dropColumn('bom_id');
        });
        Schema::table('bom_bill_of_materials', function(Blueprint $table){
            $table->renameColumn('id', 'bom_id');
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
