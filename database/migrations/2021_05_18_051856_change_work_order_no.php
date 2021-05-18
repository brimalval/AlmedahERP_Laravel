<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWorkOrderNo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('work_order', 'work_order_no')) {
            Schema::table('work_order', function(Blueprint $table) {
                $table->dropColumn('work_order_no');
            });
        }
        Schema::table('work_order', function(Blueprint $table) {
            $table->id();
            $table->string('work_order_no')->unique();
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
