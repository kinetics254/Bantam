<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_entries', function (Blueprint $table) {
            $table->id();
            $table->string('Table_ID', 50)->nullable();
            $table->enum('Document_Type', ['Leave', 'Training', 'Appraisal', 'Succession', 'Payroll', 'Recruitment']);
            $table->string('Document_No',50);
            $table->integer('Sequence_No');
            $table->enum('Status',['Created', 'Open', 'Canceled', 'Rejected', 'Approved']);
            $table->string('Approval_Details',255)->nullable();
            $table->string('Sender_ID',50)->nullable();
            $table->string('Approver_ID', 50);
            $table->string('Document_Owner', 50)->nullable();
            $table->dateTime('Date_Time_Sent_for_Approval')->nullable();
            $table->date('Last_Date_Time_Modified')->nullable();
            $table->string("Last_Modified_By_ID",50)->nullable();
            $table->string("Comment",50)->nullable();
            $table->date("Due_Date")->nullable();
            $table->foreign("Approver_ID")->references("no")->on("employees")->onDelete('cascade');
            $table->foreign("Sender_ID")->references("No")->on("employees")->onDelete('cascade');
            $table->unique(['Approver_ID', 'Sequence_No', 'Document_No', 'Document_Type'], 'approval_entries_composite_key');
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
        Schema::dropIfExists('approval_entries');
    }
}
