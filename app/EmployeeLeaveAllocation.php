<?php

namespace App;

use Illuminate\Support\Facades\DB;

class EmployeeLeaveAllocation extends BaseModel
{
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = DB::getSchemaBuilder()->getColumnListing($this->table);
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'Employee_No', 'No');
    }
}
