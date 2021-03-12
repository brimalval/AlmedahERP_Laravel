<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('man_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_lname');
            $table->string('customer_fname');
            $table->string('branch_name');
            $table->string('contact_number');
            $table->string('address');
            $table->string('email_address');
            $table->string('company_name');
            $table->string('profile_picture');
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
        Schema::dropIfExists('customers');
    }
}
