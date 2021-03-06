<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_periods', function (Blueprint $table) {
            $table->id();
            $table->date('Starting_Date')->unique();
            $table->string('Name', 50)->nullable();
            $table->boolean("New_Fiscal_Year")->nullable();
            $table->boolean("Closed")->nullable();
            $table->boolean("Date_Locked")->nullable();
            $table->date("Close_Date")->nullable();
            $table->string("Closed_By" ,50)->nullable();
            $table->boolean("Current")->nullable();
            $table->unique(['Name', 'Starting_Date']);
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
        Schema::dropIfExists('pay_periods');
    }
}
