<?php

namespace App;

class ApprovalTemplate extends BaseModel
{
    //Approval entries per template type
    public function Approval_entries(){
        return $this->hasMany(ApprovalEntries::class,"Approval_template",'id');
    }
}
