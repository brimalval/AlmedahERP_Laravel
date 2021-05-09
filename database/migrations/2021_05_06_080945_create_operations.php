<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('operation_id')->unique();
            $table->string('operation_name');
            $table->longText('description');
            $table->string('wc_code');
        });

        Schema::table('routings', function (Blueprint $table) {
            $table->foreign('operation_id')->references('operation_id')->on('operations')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
