<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('Code',20)->unique();
            $table->string('Description',20);
            $table->decimal('Days',5,2);
            $table->boolean('InActive');
            $table->boolean('Accrue_Days');
            $table->boolean('Allow_Application')->default(false);
            $table->boolean('Unlimited_Days');
            $table->enum('Gender',['Male','Female','Both']);
            $table->string('Balance', 30);
            $table->boolean('Inclusive_of_Holidays');
            $table->decimal('Max_Carry_Forward_Days',5,2);
            $table->boolean('Off_Holidays_Days_Leave');
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
        Schema::dropIfExists('leave_types');
    }
}
