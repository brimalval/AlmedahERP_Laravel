<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkcenterColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_center', function(Blueprint $table){
            $table->integer('production_capacity');
            $table->double('electricity_cost', 10, 2);
            $table->double('consumable_cost', 10, 2);
            $table->double('rent_cost', 10, 2);
            $table->double('wages', 10, 2);
            $table->double('hour_rate', 10, 2);
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
        Schema::table('work_center', function(Blueprint $table){
            $table->dropColumn('production_capacity');
            $table->dropColumn('electricity_cost');
            $table->dropColumn('consumable_cost');
            $table->dropColumn('rent_cost');
            $table->dropColumn('wages');
            $table->dropColumn('hour_rate');
        });
    }
}
