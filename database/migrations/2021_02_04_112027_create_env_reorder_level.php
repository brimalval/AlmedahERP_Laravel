<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvReorderLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env_reorder_level', function(Blueprint $table){
            $table->id();
            $table->string('reorder_id', 50)->unique();
            $table->string('item_code', 50);
            $table->foreign('item_code')->references('item_code')->on('env_raw_materials');
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
        Schema::dropIfExists('env_reorder_level');
    }
}
