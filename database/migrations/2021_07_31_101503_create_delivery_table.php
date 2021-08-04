<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id')->nullable();
            $table->foreign('sales_id')->references('id')->on('salesOrder');
            $table->string('delivery_status');
            $table->date('date_received');
            $table->date('delivery_date');
            $table->string('person_received');
            $table->string('delivery_address');
            $table->string('employee_id')->nullable();
            $table->foreign('employee_id')->references('employee_id')->on('env_employees');
            $table->string('vehicle_plate_no');
            $table->rememberToken();
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
        Schema::dropIfExists('delivery');
    }
}
