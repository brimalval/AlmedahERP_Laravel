<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_quotation', function (Blueprint $table) {
            $table->id();
            $table->string('req_quotation_id')->unique();
            $table->date('date_created');
            $table->string('request_id');
            $table->foreign('request_id')->references('request_id')->on('env_material_requests');
            $table->json('item_list');
            $table->string('req_status');
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
        Schema::dropIfExists('materials_quotation');
    }
}
