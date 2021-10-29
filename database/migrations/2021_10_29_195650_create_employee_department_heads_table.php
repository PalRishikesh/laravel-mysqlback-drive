<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDepartmentHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_department_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_department_id')->unsigned();
            $table->bigInteger('employee_head_id')->unsigned();
            $table->foreign('employee_department_id')->references('id')->on('employee_departments');
            $table->foreign('employee_head_id')->references('id')->on('department_heads');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_department_heads');
    }
}
