<?php

namespace App\Http\Controllers\Timesheet;

use App\Activity;
use App\Http\Controllers\BaseController;

class ActivityController extends BaseController
{
    public function __construct($model = Activity::class, $resource = null)
    {
        parent::__construct($model, $resource);
    }
}
