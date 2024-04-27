<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WaterIntake;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WaterIntakeController extends Controller
{
    public function addWaterIntake(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            "user_id" => "required",
            "water_amount" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            if (User::where('id', $data['user_id'])->exists()) {
                $user = User::find($data['user_id']);
                $water_intake = new WaterIntake([
                    "water_amount" => $data['water_amount']
                ]);
                $user->waterIntakes()->save($water_intake);
                return new JsonResponse([
                    "success" => true,
                    "message" => "Success",
                    "water_intake" => $water_intake,
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "User doesn't exist",
                ]);
            }
        }
    }
}
