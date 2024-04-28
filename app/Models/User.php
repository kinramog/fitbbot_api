<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $fillable = [
        "chat_id",
        "total_water_amount",
    ];

    public function waterIntakes()
    {
        return $this->hasMany(WaterIntake::class, 'user_id', "id");
    }
}
