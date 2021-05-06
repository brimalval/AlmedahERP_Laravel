<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTableNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('jobs_scheduling');
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('env_employees');
        Schema::create('env_employees', function (Blueprint $table) {
            $table->string('employee_id')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('position');
            $table->enum('gender', array('Male', 'Female'));
            $table->string('contact_number');
            $table->string('email');
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('env_employees');
    }
}
