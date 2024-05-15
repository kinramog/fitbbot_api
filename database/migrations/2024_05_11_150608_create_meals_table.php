<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("name");
            $table->unsignedInteger('total_calories');
            $table->unsignedInteger('total_proteins');
            $table->unsignedInteger('total_fat');
            $table->unsignedInteger('total_carbohydrates');
            $table->timestamps();

            $table->index("user_id", "meal_user_idx");
            $table->foreign("user_id", "meal_user_fk")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
