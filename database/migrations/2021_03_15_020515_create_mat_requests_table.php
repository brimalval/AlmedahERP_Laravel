<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env_material_requests', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->id();
            $table->string('request_id')->unique();
            $table->date('request_date');
            $table->date('required_date');
            $table->string('purpose');
            $table->string('mr_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('env_material_requests');
    }
}
