<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('routing_id')->unique();
            $table->string('routing_name');
            $table->string('sequence_id');
            $table->string('operation_id');
            $table->float('hour_rate', 10, 2);
            $table->time('operation_time');
            $table->float('operating_cost', 10, 2);
        });

        Schema::table('bom_bill_of_materials', function (Blueprint $table) {
            $table->foreign('routing_id')->references('routing_id')->on('routings')->change();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routings');
    }
}
