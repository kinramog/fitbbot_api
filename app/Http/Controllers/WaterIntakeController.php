<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WaterIntake;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WaterIntakeController extends Controller
{
    public function addWaterIntake(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "chat_id" => "required",
            "water_amount" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            if (User::where('chat_id', $data['chat_id'])->exists()) {
                $user = User::where("chat_id", $data['chat_id'])->first();
                $water_intake = new WaterIntake([
                    "user_id" => $user->id,
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

    public function todayIntakes(Request $request, $chat_id)
    {
        if (User::where('chat_id', $chat_id)->exists()) {
            $user = User::where("chat_id", $chat_id)->first();
            $userIntakes = $user->waterIntakes;
            $todayIntakes = $userIntakes->where('created_at', '>=', Carbon::today()->format('Y-m-d'));

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "water_intakes" => $todayIntakes,
            ]);
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "User doesn't exist",
            ]);
        }
    }
}
