<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WaterIntakeController;
use Illuminate\Support\Facades\Route;

Route::post('/create-user', [UserController::class, "createUser"]);
Route::get('/get-user/{chat_id}', [UserController::class, "getUser"]);
Route::patch('/change-water-balance', [UserController::class, "changeWaterBalance"]);
Route::patch('/change-timezone', [UserController::class, "changeTimezone"]);
Route::post('/add-water-intake', [WaterIntakeController::class, "addWaterIntake"]);
Route::get('/today-water-intakes/{chat_id}', [WaterIntakeController::class, "todayIntakes"]);


Route::patch('/change-user', [UserController::class, "changeParameters"]);
