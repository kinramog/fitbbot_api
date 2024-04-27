<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterIntake extends Model
{
    use HasFactory;

    protected $table = "water_intakes";

    protected $fillable = [
        "user_id",
        "water_amount",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
