<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkOrderNoToEnvMaterialRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('env_material_requests', function (Blueprint $table) {
            $table->bigInteger('work_order_no')->nullable()->unsigned();
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
        Schema::table('env_material_requests', function (Blueprint $table) {
            $table->dropColumn('work_order_no');
        });
    }
}
