<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            "chat_id" => "required | unique:users",
            "total_water_amount" => "required",
            "timezone" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            $user = [
                "chat_id" => $data['chat_id'],
                "total_water_amount" => $data['total_water_amount'],
                "timezone" => $data['timezone'],
            ];
            User::create($user);

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "user" => $user
            ]);
        }
    }

    public function changeWaterBalance(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            "chat_id" => "required",
            "total_water_amount" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            $user = User::where("chat_id", $data["chat_id"])->first();
            $user->update(["total_water_amount" => $data["total_water_amount"]]);

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "user" => $user
            ]);
        }
    }

    public function getUser($chat_id)
    {
        if (User::where('chat_id', $chat_id)->exists()) {
            $user = User::where("chat_id", $chat_id)->first();
            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "user" => $user,
            ]);
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "User doesn't exist",
            ]);
        }
    }
    
}
