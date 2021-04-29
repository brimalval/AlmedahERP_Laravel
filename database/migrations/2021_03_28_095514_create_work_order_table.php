<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_order', function (Blueprint $table) {
            $table->bigIncrements('work_order_no');
            $table->string('mat_ordered_id')->nullable();
            $table->foreign('mat_ordered_id')->references('mat_ordered_id')->on('materials_ordered');
            $table->unsignedBigInteger('sales_id');
            $table->foreign('sales_id')->references('id')->on('salesOrder');
            $table->date('planned_start_date')->nullable();
            $table->date('planned_end_date')->nullable();
            $table->date('real_start_date')->nullable();
            $table->date('real_end_date')->nullable();
            $table->string('work_order_status');
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
        Schema::dropIfExists('work_order');
    }
}
