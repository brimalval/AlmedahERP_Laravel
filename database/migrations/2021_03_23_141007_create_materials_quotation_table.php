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
        Schema::create('request_quotation', function (Blueprint $table) {
            $table->id('req_quotation_id');
            $table->date('date_created');
            $table->string('request_id');
            $table->foreign('request_id')->references('request_id')->on('env_material_requests');
            $table->json('item_list');
            $table->string('req_status')->default('Draft');
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
        Schema::dropIfExists('request_quotation');
    }
}
