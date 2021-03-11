<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterials2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('raw_materials2')) {
            Schema::create('raw_materials2', function (Blueprint $table) {
                $table->id();
                $table->string('item_code');
                $table->string('item_name');
                $table->string('category');
                $table->string('UOM');
                $table->integer('in_stock');
                $table->integer('not_instock');
                $table->integer('station_design_quantity');
                $table->integer('station_assembly_quantity');
                $table->integer('station_repair_quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_materials2');
    }
}
