<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeLeaveApplication;
use App\Http\Resources\ChangelogResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class EmployeeController extends Controller
{


    public function index(Request $request)
    {
        $this->authorize('index', Employee::class);
        return EmployeeResource::collection($this->filter($request->all())->paginate());
    }

    public function show(Request $request, Employee $employee)
    {
        $this->authorize('view', $employee);
        if($request->is('api*')){
            return new EmployeeResource($employee);
        }
    }

    public function user(Request $request, Employee $employee){
        $this->authorize('view', $employee);
        if($request->is('api*')){
            return new UserResource($employee->user);
        }
    }

    public function payslip(Request $request){
        $this->authorize('view', $request->user()->Employee_Record);
        $employee = $request->user()->Employee_Record;
        return $this->getEmployeePayslip($employee, $request);
    }

    public function employee_payslip(Request $request, Employee $employee){
        return $this->getEmployeePayslip($employee, $request);
    }

    public function calculate_dates(Request $request, Employee $employee){
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'leave_code' => 'required',
            'Document_No' => 'sometimes'
        ]);

        $application = null;

        $application = isset($validatedData['Document_No']) ? EmployeeLeaveApplication::where('Application_Code',
            $validatedData['Document_No'])->first() : null;
        return json_encode((array)$this->calculateEmployeeLeaveDates($validatedData, $employee, $application));
    }

    private function getEmployeePayslip(Employee $employee, $request){

        $validatedData = (object)$request->validate([
            'period' => "required"
        ]);

        $manager = new NavSyncManager();

        $base64 = $manager->getPayslip($request->user()->Employee_Record, $validatedData->period );
        $pdf_string = base64_decode($base64);

        $headers = [
            'Content-type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'."$employee->No-$validatedData->period.pdf".'"',
        ];

        return \Response::make($pdf_string, 200, $headers);
    }

    private function filter($filters){
        $model = Employee::class;
        $query = $model::query();
        $count = 0;

        $columns = Schema::getColumnListing((new $model())->getTable());
        foreach ($filters as $key => $val){
            if(!in_array($key, $columns)){
                unset($filters[$key]);
            }
        }

        foreach ((new $model())->getHidden() as $hidden){
            if(key_exists($hidden, $filters)){
                unset($filters[$hidden]);
            }
        }
//        dd($filters);
        foreach ($filters as $key => $value){
            if(is_array($value)){
                $query->where(function($arr_query) use ($value, $key){
                    $arr_count = 0;
                    foreach ($value as $item){
                        if($arr_count == 0){
                            $arr_query->where($key, $item);
                        }
                        else{
                            $arr_query->orWhere($key, $item);
                        }
                        $arr_count++;
                    }
                });

            }
            else{
                if($count == 0){
                    $query = $query->where($key, $value);
                }
                else{
                    $query = $query->where($key, $value);
                }
            }
            $count++;
        }
        return $query;
    }

    public function changelog(Employee $employee, Request $request){
        return ChangelogResource::collection($employee->audits()->paginate());
    }
}
