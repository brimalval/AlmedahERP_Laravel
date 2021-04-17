<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableRfqIdOnSuppliersQuotation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers_quotation', function (Blueprint $table) {
            $table->string('req_quotation_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers_quotation', function (Blueprint $table) {
            $table->string('req_quotation_id')->nullable(false)->change();
        });
    }
}
