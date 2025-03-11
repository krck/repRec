<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plan_workouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_shared');
            $table->timestamps();
        });

        Schema::create('plan_workout_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('plan_workout_id');
            $table->foreign('plan_workout_id')->references('id')->on('plan_workouts')->onDelete('cascade');
            $table->unsignedBigInteger('exercise_category_id');
            $table->foreign('exercise_category_id')->references('id')->on('exercise_categories')->onDelete('no action');
            $table->unsignedBigInteger('exercise_id');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('no action');
            $table->unsignedInteger('day_index');
            $table->unsignedInteger('day_order');
            $table->text('exercise_definition_json');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_workout_exercises');
        Schema::dropIfExists('plan_workouts');
    }
};
