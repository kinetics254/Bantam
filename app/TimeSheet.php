<?php

namespace App;


class TimeSheet extends BaseModel
{
    protected $fillable = [
        "Employee",
        "Project",
        "Activity",
        "Task",
        "Location",
        "Hours",
        "Date",
        "Comments",
        "Status",
    ];
}
