<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatRequestTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env_material_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_id');
            $table->string('item_code');
            $table->integer('quantity');
            $table->date('required_date');
            $table->string('reorder_id');
            $table->string('purpose');
            $table->string('uom_id');
            $table->string('station_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mat_request_tbl');
    }
}
