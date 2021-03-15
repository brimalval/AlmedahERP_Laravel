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
            $table->string('jobs_sched_id');
            $table->string('wbs_code');
            $table->string('predecessor');
            $table->string('successor');
            $table->string('part_code');
            $table->string('component_code');
            $table->string('task_id');
            $table->foreign('task_id')->references('task_id')->on('jobs');
            $table->string('machine_code');
            $table->time('setup_time');
            $table->float('running_time');
            $table->float('total_hours');
            $table->float('days');
            $table->float('hrs');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('js_status');
            //id in employees table is an integer...
            $table->string('employee_id');
            $table->string('mfg_order_no');
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
