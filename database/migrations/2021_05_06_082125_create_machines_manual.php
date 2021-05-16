<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesManual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('machines_manual');

        Schema::create('machines_manual', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('machine_code')->unique();
            $table->string('machine_name');
            $table->binary('machine_image');
            $table->string('machine_description');
            $table->string('machine_process');
            $table->float('set-up_time');
            $table->float('running_time');
        });

        Schema::table('work_center', function (Blueprint $table) {
            $table->foreign('machine_code')->references('machine_code')->on('machines_manual')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_center', function (Blueprint $table) {
            $table->dropForeign(['machine_code']);
        });
        Schema::dropIfExists('machines_manual');
    }
}
