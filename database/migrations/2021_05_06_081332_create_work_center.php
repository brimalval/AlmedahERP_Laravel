<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkCenter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_center', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('wc_code')->unique();
            $table->string('wc_label');
            $table->string('wc_type');
            $table->string('machine_code')->nullable();
            $table->string('employee_id')->nullable();
            $table->foreign('employee_id')->references('employee_id')->on('env_employees');
            $table->string('duration')->nullable();
        });

        Schema::table('operations', function (Blueprint $table) {
            $table->foreign('wc_code')->references('wc_code')->on('work_center')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_center');
    }
}
