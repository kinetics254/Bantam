<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeApproversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_approvers', function (Blueprint $table) {
            $table->id();
            $table->string('Employee',50);
            $table->integer('Approval_Level');
            $table->string('Approver',50);
            $table->string("NamesApprvr");
            $table->string("Comments", 50)->nullable();
            $table->foreign('Employee')->references('No')->on('employees');
            $table->foreign('Approver')->references('No')->on('employees');
            $table->audits();
            $table->unique(['Employee',  'Approver', 'Approval_Level']);
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
        Schema::dropIfExists('employee_approvers');
    }
}
