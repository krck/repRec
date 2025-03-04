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
        Schema::create('exercise_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('json_template');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_category_id');
            $table->foreign('exercise_category_id')->references('id')->on('exercise_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('primary_muscles');
            $table->string('secondary_muscles')->nullable();
            $table->string('mechanic');
            $table->string('level');
            $table->string('force');
            $table->string('equipment');
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('exercise_categories');
    }
};
