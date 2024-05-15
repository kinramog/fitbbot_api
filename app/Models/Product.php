<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        "meal_id",
        "name",
        "calories",
        "proteins",
        "fat",
        "carbohydrates",
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class, "meal_id", "id");
    }
}
