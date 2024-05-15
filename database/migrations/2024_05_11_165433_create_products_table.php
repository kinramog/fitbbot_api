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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id');
            $table->string("name");
            $table->unsignedInteger('calories');
            $table->unsignedInteger('proteins');
            $table->unsignedInteger('fat');
            $table->unsignedInteger('carbohydrates');
            $table->timestamps();

            $table->index("meal_id", "product_meal_idx");
            $table->foreign("meal_id", "product_meal_fk")->on("meals")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
