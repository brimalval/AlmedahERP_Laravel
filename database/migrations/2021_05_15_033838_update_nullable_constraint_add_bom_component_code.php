<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableConstraintAddBomComponentCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bom_bill_of_materials', function (Blueprint $table) {
            $table->string('product_code')->nullable()->change();
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
        Schema::table('bom_bill_of_materials', function (Blueprint $table) {
            $table->dropForeign(['component_code']);
            $table->dropColumn('component_code');
            $table->string('product_code')->nullable(false)->change();
        });
    }
}
