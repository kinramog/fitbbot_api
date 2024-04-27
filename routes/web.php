<?php

use App\Models\User;
use App\Models\WaterIntake;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pupa', function () {
    $wata = WaterIntake::find(1);    
    dump($wata->user->total_water_amount);
    $users = User::find(1);    
    dd($users->waterIntakes[0]->water_amount);
}
);
