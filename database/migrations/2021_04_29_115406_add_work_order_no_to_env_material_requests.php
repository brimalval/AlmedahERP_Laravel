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
            $table->bigInteger('work_order_no')->unsigned()->nullable();
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
        if(Schema::hasColumn('env_material_requests', 'work_order_no')) {
            Schema::table('env_material_requests', function (Blueprint $table) {
                $table->dropColumn('work_order_no');
            });
        }
    }
}
