<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWorkOrderInMatReq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('env_material_requests', function (Blueprint $table) {
            if(Schema::hasColumn('env_material_requests', 'work_order_no')) {
                Schema::table('env_material_requests', function(Blueprint $table) {
                    $table->dropForeign(['work_order_no']);
                    $table->dropColumn('work_order_no');
                });
            }
            Schema::table('env_material_requests', function(Blueprint $table) {
                $table->string('work_order_no')->nullable();
             });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mat_req', function (Blueprint $table) {
            //
        });
    }
}
