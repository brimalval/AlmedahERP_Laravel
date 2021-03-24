<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedRawMatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('request_id');
            $table->foreign('request_id')->references('request_id')->on('env_material_requests');
            $table->string('item_code');
            $table->foreign('item_code')->references('item_code')->on('env_raw_materials');
            $table->integer('quantity_requested');
            $table->string('station_id');
            $table->foreign('station_id')->references('station_id')->on('stations');
            $table->string('procurement_method');
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
        Schema::dropIfExists('requested_raw_materials');
    }
}
