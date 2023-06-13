<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('full_name');
            $table->string('job_title');
            $table->string('department');
            $table->string('business_unit');
            $table->string('gender');
            $table->string('ethnicity');
            $table->integer('age');
            $table->date('hire_date');
            $table->string('annual_salary');
            $table->string('bonus');
            $table->string('country');
            $table->string('city');
            $table->string('exit');
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
        Schema::dropIfExists('employees');
    }
};
