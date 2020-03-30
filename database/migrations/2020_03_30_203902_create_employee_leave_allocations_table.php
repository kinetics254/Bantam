<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeaveAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leave_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('Leave_Period', 50);
            $table->string('Employee_No', 50);
            $table->string('Leave_Code',20);
            $table->string('LTypes_Description',255);
            $table->date('Maturity_Date');
            $table->decimal('Balance_B_F',5,2);
            $table->decimal('Accrued_Days',5,2);
            $table->decimal('Allocated_Days',5,2);
            $table->decimal('Taken',5,2);
            $table->decimal('Balance',5,2);
            $table->string('Comments',250)->nullable();
            $table->foreign("Employee_No")->references("No")->on("employees")->onDelete('cascade');
            $table->unique(['Employee_No', 'Leave_Period', 'Leave_Code'], 'employee_leave_allocations_composite_key');
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
        Schema::dropIfExists('employee_leave_allocations');
    }
}
