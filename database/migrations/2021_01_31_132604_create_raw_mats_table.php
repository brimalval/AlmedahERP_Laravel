<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('env_raw_materials'))
        {
                Schema::create('env_raw_materials', function (Blueprint $table) {
                $table->id();
                $table->string('item_code')->unique();
                $table->string('item_name');
                $table->json('item_image');
                $table->string('category_id');
                $table->float('rm_quantity');
                $table->float('stock_quantity');
                $table->float('reorder_level');
                $table->float('reorder_qty');
                $table->string('rm_status');
                $table->timestamps();
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
        Schema::dropIfExists('env_raw_materials');
    }
}
