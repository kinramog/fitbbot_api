<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $table = "meals";

    protected $fillable = [
        "user_id",
        "name",
        "total_calories",
        "total_proteins",
        "total_fat",
        "total_carbohydrates",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'meal_id', "id");
    }
}
