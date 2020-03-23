<?php

namespace App\Http\Controllers\Timesheet;

use App\Http\Controllers\BaseController;
use App\Task;

class TaskController extends BaseController
{
   public function __construct($model = Task::class, $resource = null)
   {
       parent::__construct($model, $resource);
   }
}
