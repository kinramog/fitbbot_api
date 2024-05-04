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
    ];

    public function waterIntakes()
    {
        return $this->hasMany(WaterIntake::class, 'user_id', "id");
    }
}
