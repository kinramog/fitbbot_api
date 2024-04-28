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
            "user_id" => "required",
            "total_water_amount" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            $user = User::find($data["user_id"]);
            $user->update(["total_water_amount" => $data["total_water_amount"]]);

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "user" => $user
            ]);
        }
    }

    public function getUser(Request $request)
    {
        $data = $request->all();
        $user = User::find($data["user_id"]);        
        return new JsonResponse($user);
        
    }
}
