<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobsSchedulingAddWorkOrderForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs_scheduling', function (Blueprint $table) {
            $table->foreign('work_order_no')->references('work_order_no')->on('work_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs_scheduling', function (Blueprint $table) {
            $table->dropForeign(['work_order_no']);
        });
    }
}
