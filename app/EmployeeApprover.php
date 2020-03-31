<?php

namespace App;

class EmployeeApprover extends BaseModel
{
    //approval entries per an approver
    public function Approval_entries(){
        return $this->hasMany(ApprovalEntries::class,"Approver_id",'id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class, "Employee", "No");
    }

    public function approver(){
        return $this->belongsTo(Employee::class, "Approver", "No");
    }
}
