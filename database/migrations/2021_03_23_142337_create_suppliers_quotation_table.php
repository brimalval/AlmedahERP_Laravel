<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_quotation', function (Blueprint $table) {
            $table->id();
            $table->string('supp_quotation_id')->unique();
            $table->date('date_created');
            $table->string('req_quotation_id');
            $table->foreign('req_quotation_id')->references('req_quotation_id')->on('materials_quotations');
            $table->json('items_list_rate_amt');
            $table->float('grand_total');
            $table->string('remarks')->nullable();;
            $table->string('sq_status');
            $table->timestamps();
        });

        Schema::table('materials_purchased', function(Blueprint $table){
            $table->foreign('supp_quotation_id')->references('supp_quotation_id')->on('suppliers_quotation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materials_purchased', function(Blueprint $table){
            $table->dropForeign('supp_quotation_id');
        });

        Schema::dropIfExists('suppliers_quotation');
    }
}
