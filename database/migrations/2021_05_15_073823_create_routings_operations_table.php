<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutingsOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routings', function (Blueprint $table) {
            $table->dropForeign(['operation_id']);
        });
        Schema::table('routings', function (Blueprint $table) {
            $table->dropColumn('sequence_id');
            $table->dropColumn('operation_id');
            $table->dropColumn('hour_rate');
            $table->dropColumn('operation_time');
            $table->dropColumn('operating_cost');
        });
        Schema::create('routings_operations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('operation_id');
            $table->foreign('operation_id')->references('operation_id')->on('operations')->change();
            $table->string('sequence_id');
            $table->float('hour_rate', 10, 2);
            $table->time('operation_time');
            $table->float('operating_cost', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routings_operations');
    }
}
