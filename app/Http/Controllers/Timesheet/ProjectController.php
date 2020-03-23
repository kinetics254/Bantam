<?php

namespace App\Http\Controllers\Timesheet;

use App\Http\Controllers\BaseController;
use App\Project;

class ProjectController extends BaseController
{
    public function __construct($model = Project::class, $resource = null)
    {
        parent::__construct($model, $resource);
    }
}
