<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoutingIdRoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('routings_operations', function (Blueprint $table) {
            $table->string('routing_id');
            $table->foreign('routing_id')->references('routing_id')->on('routings');
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
        Schema::table('routings_operations', function (Blueprint $table) {
            $table->dropForeign(['routing_id']);
            $table->dropColumn('routing_id');
        });
    }
}
