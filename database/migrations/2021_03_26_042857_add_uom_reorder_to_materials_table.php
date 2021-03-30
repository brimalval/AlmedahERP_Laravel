<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUomReorderToMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('env_raw_materials', function (Blueprint $table) {
            $table->string('uom_id')->default('nos');
            $table->foreign('uom_id')->references('uom_id')->on('materials_uom');
            $table->integer('reorder_level');
            $table->integer('reorder_qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('env_raw_materials', function (Blueprint $table) {
            $table->dropForeign(['uom_id']);
            $table->dropColumn('uom_id');
            $table->dropColumn('reorder_level');
            $table->dropColumn('reorder_qty');
        });
    }
}
