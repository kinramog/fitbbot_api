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
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender', 64)->default(0)->after("timezone");
            $table->unsignedTinyInteger('age')->default(0)->after("timezone");
            $table->unsignedSmallInteger('weight')->default(0)->after("timezone");
            $table->unsignedSmallInteger('height')->default(0)->after("timezone");

            $table->unsignedInteger("total_carbohydrates")->default(0)->after("total_water_amount");
            $table->unsignedInteger("total_fat")->default(0)->after("total_water_amount");
            $table->unsignedInteger("total_proteins")->default(0)->after("total_water_amount");
            $table->unsignedInteger("total_calories")->default(0)->after("total_water_amount");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('age');
            $table->dropColumn('gender');
            $table->dropColumn('total_carbohydrate');
            $table->dropColumn('total_fat');
            $table->dropColumn('total_proteins');
            $table->dropColumn('total_calories');
        });
    }
};
