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
            $table->bigIncrements('id');
            $table->string('jobs_sched_id')->unique();
            $table->string('wbs_code');
            $table->foreign('wbs_code')->references('wbs_code')->on('wbs');
            $table->string('predecessor');
            $table->string('successor');
            $table->string('part_code');
            $table->foreign('part_code')->references('part_code')->on('parts');
            $table->string('component_code');
            $table->foreign('component_code')->references('component_code')->on('components');
            $table->string('task_id');
            $table->foreign('task_id')->references('task_id')->on('jobs');
            $table->string('machine_code');
            $table->foreign('machine_code')->references('machine_code')->on('machines_manual');
            $table->time('setup_time');
            $table->float('running_time');
            $table->float('total_hours');
            $table->float('days');
            $table->float('hrs');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('js_status');
            #Cannot reference from employees table for now: id from employees table is an integer
            $table->string('employee_id');
            #No table to reference yet
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
