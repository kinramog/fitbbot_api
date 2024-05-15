<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    public function addMeal(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "chat_id" => "required",
            "name" => "required",
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
            if (User::where('chat_id', $data['chat_id'])->exists()) {
                $user = User::where("chat_id", $data['chat_id'])->first();
                $meal = new Meal([
                    "user_id" => $user->id,
                    "name" => $data["name"],
                    "total_calories" => $data["total_calories"],
                    "total_proteins" => $data["total_proteins"],
                    "total_fat" => $data["total_fat"],
                    "total_carbohydrates" => $data["total_carbohydrates"],
                ]);

                $user->meals()->save($meal);
                return new JsonResponse([
                    "success" => true,
                    "message" => "Success",
                    "meal" => $meal,
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "User doesn't exist",
                ]);
            }
        }
    }

    public function todayMeals($chat_id)
    {
        if (User::where('chat_id', $chat_id)->exists()) {
            $user = User::where("chat_id", $chat_id)->first();
            $userMeals = $user->meals;
            $timezone = $user->timezone;
            $localDayStartInUTC = Carbon::today($timezone)->subHour(Carbon::today()->offsetHours);

            $todayMeals = $userMeals->where('created_at', '>=', $localDayStartInUTC);

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "today_meals" => $todayMeals,
            ]);
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "User doesn't exist",
            ]);
        }
    }



    public function addProducts(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "meal_id" => "required",
            "products" => "required",
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                "success" => false,
                "message" => $validator->errors(),
            ]);
        } else {
            if (Meal::where('id', $data['meal_id'])->exists()) {
                $meal = Meal::where("id", $data['meal_id'])->first();
                $products = [];
                foreach ($data["products"] as $product) {
                    $products[] = new Product([
                        "meal_id" => $data["meal_id"],
                        "name" => $product["name"],
                        "calories" => $product["calories"],
                        "proteins" => $product["proteins"],
                        "fat" => $product["fat"],
                        "carbohydrates" => $product["carbohydrates"],
                    ]);
                }
                $meal->products()->saveMany($products);

                return new JsonResponse([
                    "success" => true,
                    "message" => "Success",
                    "products" => $products,
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "Meal doesn't exist",
                ]);
            }
        }
    }

    public function getProductsFromMeal($meal_id)
    {
        if (Meal::where('id', $meal_id)->exists()) {
            $meal = Meal::where("id", $meal_id)->first();
            $mealProducts = $meal->products;

            return new JsonResponse([
                "success" => true,
                "message" => "Success",
                "products" => $mealProducts,
            ]);
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "Meal doesn't exist",
            ]);
        }
    }

}
