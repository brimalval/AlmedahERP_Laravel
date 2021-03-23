<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedRmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_rm', function (Blueprint $table) {
            $table->id();
            $table->foreign('request_id')->references('request_id')->on('env_material_requests');
            $table->float('quantity_requested');
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
        Schema::dropIfExists('requested_rm');
    }
}
