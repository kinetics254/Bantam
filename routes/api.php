<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function (){
   Route::post('/login', 'SanctumAuthController@login');
   Route::middleware('auth:sanctum')->post('/logout', 'SanctumAuthController@logout');
});

Route::group(['namespace' => 'Timesheet', 'prefix' => 'time-sheets', 'middleware' => 'auth:sanctum'], function (){
    Route::get('/', 'TimeSheetController@index');
    Route::post('/', 'TimeSheetController@store');
});

Route::resource('users', 'UserController')->only(['index', 'show'])->middleware('auth:sanctum');;
Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function (){
    Route::get('{user}/employee', 'UserController@employee');
    Route::get('notification', 'Notification@index');
    Route::get('notification/unread', 'Notification@UnreadNotifications');
    Route::get('notification/read', 'Notification@ReadNotifications');
    Route::get('notification/markasread', 'Notification@update');
    Route::get('current', 'UserController@current');
    Route::get('{user}/changelog', 'UserController@changelog');
});

Route::resource('employees', 'EmployeeController')->only(['index', 'show'])->middleware('auth:sanctum');
Route::group(['prefix' => 'employee', 'middleware' => 'auth:sanctum'], function (){
    Route::get('/employees', 'EmployeeController@index');
    Route::get('/leave_applications', 'LeaveApplicationController@leave_applications');
    Route::put('/leave_application/{appCode}/cancel', 'LeaveApplicationController@update');
    Route::get('/approvals', 'ApprovalEntriesController@current_employee_approvals');
    Route::get('/approvers', 'EmployeeApproverController@approvers');
    Route::get('/payslip', 'EmployeeController@payslip');
    Route::get('/leave_types', 'LeaveAllocationController@current_employee_leave_types');

    Route::get('{employee}/user', 'EmployeeController@user');
    Route::get('{employee}/picture', 'EmployeeController@picture');
    Route::get('{employee}/leave_allocations', 'LeaveAllocationController@EmployeeLeaveAllocations');
    Route::get('{employee}/leave_applications', 'LeaveApplicationController@EmployeeLeaveApplications');
    Route::get('{employee}/leave_types', 'LeaveTypeController@LeaveTypes');
    Route::post('{employee}/payslip', 'EmployeeController@employee_payslip');
    Route::get('{employee}/approvers', 'EmployeeApproverController@employee_approvers');
    Route::post('{employee}/calculate_dates', 'EmployeeController@calculate_dates');
    Route::get('{employee}/changelog', 'EmployeeController@changelog');
});


Route::group(['namespace' => 'Setup', 'prefix' => 'setup', 'middleware' => 'auth:sanctum'], function (){
    Route::get('/projects', 'ProjectController@index');
    Route::get('/activities', 'ActivityController@index');
    Route::get('/tasks', 'TaskController@index');
    Route::get('/locations', 'LocationController@index');
});


Route::group(['prefix' => 'leave_applications', 'middleware' => 'auth:sanctum'], function (){
    Route::post('calculate_leave_dates', 'LeaveApplicationController@calculateLeaveDates');
    Route::post('requests', 'LeaveApplicationController@requests');
    Route::post('{leave_applications}/status', 'LeaveApplicationController@status');
    Route::get('{leave_application}/approvals', 'ApprovalEntriesController@application_approvals');
    Route::get('disabled_days', 'LeaveApplicationController@disabled_days');
    Route::get('{leave_application}/changelog', 'LeaveApplicationController@changelog');
});


Route::prefix('approvals')->group(function () {
    Route::post('{approval}/status', 'ApprovalEntriesController@status');
    Route::get('{approval_entry}/changelog', 'ApprovalEntriesController@changelog');
});
Route::resource('approvals','ApprovalEntriesController');

Route::resource('leave_applications','LeaveApplicationController');
Route::resource('leave_allocations','LeaveAllocationController')->only(['index', 'show']);
Route::resource('leave_types','LeaveTypeController');
Route::resource('pay_periods','PayPeriodController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
