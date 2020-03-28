<?php

namespace App\Http\Controllers\Timesheet;

use App\Http\Controllers\BaseController;
use App\TimeSheet;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        try {
            $sheets = $request->all();

            foreach ($sheets as $sheet){
                $sheet = (object)$sheet;
                $timesheet = (isset($sheet->id) && !isset($sheet->set)) ? TimeSheet::find($sheet->id) : new TimeSheet();

                if (isset($sheet->deleted))
                    $timesheet->delete();

                $timesheet->fill((array)$sheet);
//                $timesheet->Entry_No = 'ENTRY000'.(TimeSheet::latest()->first()->id + 1); // todo use nav no. series
                $timesheet->save();
            }

            return response()->json([
                'message' => 'saved successfully'
            ],200);
        }catch (\Exception $exception){
            dump($exception);
        }
    }
}
