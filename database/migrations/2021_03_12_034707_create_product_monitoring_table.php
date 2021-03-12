<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_monitoring', function (Blueprint $table) {
            $table->id();
            // REMEMBER TO ADD FOREIGN KEY CONSTRAINTS TO THESE FIELDS
            $table->integer('customer_id');
            $table->integer('station_id');
            $table->string('product_code');
            // ######################################################
            $table->date('planned_start_date');
            $table->date('planned_end_date');
            $table->date('real_start_date');
            $table->date('real_end_date');
            $table->string('pm_status');
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
        Schema::dropIfExists('product_monitorings');
    }
}
