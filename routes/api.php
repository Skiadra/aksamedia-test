<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt-auth'])->group(function () {
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'getAllEmployees']);
        Route::post('/', [EmployeeController::class, 'createEmployee']);
        Route::delete('/{employee_id}', [EmployeeController::class, 'deleteEmployee']);
        Route::put('/{employee_id}', [EmployeeController::class, 'updateEmployee']);
    });
    Route::get('/divisions', [DivisionController::class, 'getAllDivisions']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
