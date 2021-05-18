<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWcMmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('machines_manual', function (Blueprint $table) {
            $table->longText('machine_process')->change();
        });
        Schema::table('work_center', function (Blueprint $table){
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            //$table->json('employee_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
