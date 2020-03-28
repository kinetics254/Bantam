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

Route::group(['namespace' => 'Employee', 'prefix' => 'employee', 'middleware' => 'auth:sanctum'], function (){
    Route::get('/employees', 'EmployeeController@index');
});



Route::group(['namespace' => 'Setup', 'prefix' => 'setup', 'middleware' => 'auth:sanctum'], function (){
    Route::get('/projects', 'ProjectController@index');
    Route::get('/activities', 'ActivityController@index');
    Route::get('/tasks', 'TaskController@index');
    Route::get('/locations', 'LocationController@index');
});
