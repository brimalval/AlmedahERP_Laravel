<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatRequestsTable extends Migration
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
            $table->string('request_id')->unique();
            $table->string('item_code');
            $table->foreign('item_code')->references('item_code')->on('env_raw_materials');
            $table->integer('quantity');
            $table->date('required_date');
            //foreign key needed here
            $table->string('reorder_id');
            //
            $table->string('purpose');
            //foreign key needed for uom
            $table->string('uom_id');
            $table->string('station_id');
            $table->string('procurement_method');
            $table->foreign('station_id')->references('station_id')->on('stations');
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
        Schema::dropIfExists('env_material_requests');
    }
}
