<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WaterIntakeController;
use Illuminate\Support\Facades\Route;

Route::post('/create-user', [UserController::class, "createUser"]);
Route::patch('/change-water-balance', [UserController::class, "changeWaterBalance"]);
Route::post('/add-water-intake', [WaterIntakeController::class, "addWaterIntake"]);


Route::post('/get-user', [UserController::class, "getUser"]);