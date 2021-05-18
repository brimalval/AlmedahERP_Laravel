<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductCodeToWorkOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_order', function (Blueprint $table) {
            // At least one of the following must have a value; this will be enforced
            // through validation in the controller
            $table->string('product_code')->nullable();
            $table->foreign('product_code')->references('product_code')->on('man_products');
            $table->string('component_code')->nullable();
            $table->foreign('component_code')->references('component_code')->on('components');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_order', function (Blueprint $table) {
            $table->dropForeign(['component_code']);
            $table->dropForeign(['product_code']);
            $table->dropColumn('component_code');
            $table->dropColumn('product_code');
        });
    }
}
