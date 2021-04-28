<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsSchedulingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_scheduling', function (Blueprint $table) {
            $table->id();
            $table->string('jobs_sched_id')->unique();
            $table->date('start_date');
            $table->time('start_time');
            $table->string('js_status');
            $table->string('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('env_employees');
            $table->string('work_order_no');
            //$table->foreign('work_order_no')->reference('work_order_no')->on('work_order');
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
        Schema::dropIfExists('jobs_scheduling');
    }
}
