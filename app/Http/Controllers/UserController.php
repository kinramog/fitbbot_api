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
            "timezone" => "required",
            "height" => "required",
            "weight" => "required",
            "age" => "required",
            "gender" => "required",
            "total_water_amount" => "required",
            "total_calories" => "required",
            "total_proteins" => "required",
            "total_fat" => "required",
            "total_carbohydrates" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            $user = [
                "chat_id" => $data['chat_id'],
                "timezone" => $data['timezone'],
                "height" => $data["height"],
                "weight" => $data["weight"],
                "age" => $data["age"],
                "gender" => $data["gender"],
                "total_water_amount" => $data["total_water_amount"],
                "total_calories" => $data["total_calories"],
                "total_proteins" => $data["total_proteins"],
                "total_fat" => $data["total_fat"],
                "total_carbohydrates" => $data["total_carbohydrates"],
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

    public function changeTimezone(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            "chat_id" => "required",
            "timezone" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            $user = User::where("chat_id", $data["chat_id"])->first();

            $user->update(["timezone" => $data["timezone"]]);

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "user" => $user
            ]);
        }
    }

    public function changeParameters(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            "chat_id" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            $user = User::where("chat_id", $data["chat_id"])->first();
            foreach (array_keys($data) as $key) {
                $user->update([$key => $data[$key]]);
            }

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "user" => $user
            ]);
        }
    }
}
