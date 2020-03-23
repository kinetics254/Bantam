<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Crud\HasCrud;
use App\Http\Controllers\FileManager\HasFile;
class BaseController extends Controller
{
    use HasCrud, HasFile;

    protected $model;
    protected $resource;

    public function __construct($model = null, $resource = null)
    {
        $this->model = $model;
        $this->resource = $resource;
    }
}
