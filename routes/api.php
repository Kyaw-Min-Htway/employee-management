<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::get('employees/{uuid}', [EmployeeController::class, 'show']);
    Route::put('employees/{uuid]', [EmployeeController::class, 'update']);
    Route::delete('employees/{uuid}', [EmployeeController::class, 'destroy']);
});
