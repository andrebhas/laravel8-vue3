<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1'], function () {
    //Employee
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::get('employees/summary', [EmployeeController::class, 'summary']);
    Route::get('employees/{id}', [EmployeeController::class, 'show']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::patch('employees', [EmployeeController::class, 'update']);

    //Company
    Route::get('company-list', [CompanyController::class, 'list']);

    //Department
    Route::get('department-list', [DepartmentController::class, 'list']);
});
