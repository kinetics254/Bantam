<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('Entry_No')->unique();
            $table->string('Employee');
            $table->string('Project');
            $table->string('Activity');
            $table->string('Task');
            $table->enum('Status', ['Pending', 'Approved', 'Declined', 'Closed'])->default('Pending');
            $table->unsignedDecimal('Hours', 8, 2);
            $table->longText('Comments')->nullable();
            $table->string('Approved_By')->nullable();
            $table->foreign('Employee')->references('No')->on('employees');
            $table->foreign('Project')->references('Code')->on('projects');
            $table->foreign('Activity')->references('Code')->on('activities');
            $table->foreign('Task')->references('Code')->on('tasks');
            $table->foreign('Approved_By')->references('No')->on('employees');;
            $table->dateTime('Date_Approved')->nullable();
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
        Schema::dropIfExists('time_sheets');
    }
}
