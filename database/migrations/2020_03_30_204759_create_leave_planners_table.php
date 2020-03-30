<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavePlannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_planners', function (Blueprint $table) {
            $table->increments('leave_planner_id');
            $table->string('employee_no',50);
            $table->string('title',100);
            $table->date('start');
            $table->date('ends');
            $table->decimal('no_of_days',8,2);
            $table->string('type',50);
            $table->string('application_code',50);
            $table->integer("current_year",false,true);
            $table->foreign("employee_no")->references("No")->on("employees")->onDelete('cascade');
            $table->foreign("application_code")->references("Application_Code")->on("employee_leave_applications")->onDelete('cascade');
            $table->audits();
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
        Schema::dropIfExists('leave_planners');
    }
}
