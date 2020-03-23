<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    public function __construct($model = Employee::class, $resource = EmployeeResource::class)
    {
        parent::__construct($model, $resource);
    }

    public function index()
    {
        $this->authorize('index', $this->model);
        return parent::index();
    }
}
