<?php

namespace App\Http\Controllers\Timesheet;

use App\Http\Controllers\BaseController;
use App\TimeSheet;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeSheetController extends BaseController
{
    public function __construct($model = TimeSheet::class, $resource = null)
    {
        parent::__construct($model, $resource);
    }

    public function index()
    {
        try{
            return JsonResource::collection($this->model::orderBy('id', 'DESC')->paginate(20));
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
