<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $fillable = [
        "id",
        "chat_id",
        "total_water_amount",
        "timezone",
        "height",
        "weight",
        "age",
        "gender",
        "total_carbohydrates",
        "total_fat",
        "total_proteins",
        "total_calories",
    ];

    public function waterIntakes()
    {
        return $this->hasMany(WaterIntake::class, 'user_id', "id");
    }
    public function meals()
    {
        return $this->hasMany(Meal::class, 'user_id', "id");
    }
}
