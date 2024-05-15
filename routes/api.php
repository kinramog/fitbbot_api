<?php

use App\Http\Controllers\MealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaterIntakeController;
use Illuminate\Support\Facades\Route;


Route::post('/create-user', [UserController::class, "createUser"]);
Route::patch('/change-user', [UserController::class, "changeParameters"]);
Route::get('/get-user/{chat_id}', [UserController::class, "getUser"]);

Route::post('/add-water-intake', [WaterIntakeController::class, "addWaterIntake"]);
Route::get('/today-water-intakes/{chat_id}', [WaterIntakeController::class, "todayIntakes"]);

Route::post('/add-meal', [MealController::class, "addMeal"]);
Route::get('/today-meals/{chat_id}', [MealController::class, "todayMeals"]);

Route::post('/add-products', [MealController::class, "addProducts"]);
Route::get('/products-from-meal/{meal_id}', [MealController::class, "getProductsFromMeal"]);



// Route::patch('/change-water-balance', [UserController::class, "changeWaterBalance"]);
// Route::patch('/change-timezone', [UserController::class, "changeTimezone"]);
