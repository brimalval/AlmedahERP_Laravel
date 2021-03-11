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
            
            $table->string('reorder_id', 50)->primary();
            $table->string('category_id',50);
            $table->integer('reorder_qty');
            $table->string('reorder_level');
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
