<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\BaseController;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    public function __construct($model = Location::class, $resource = null)
    {
        parent::__construct($model, $resource);
    }
}
