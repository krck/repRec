<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExerciseCategory;
use App\Common\Enums\EnumExerciseCategory;

class ExerciseCategorySeeder extends Seeder
{
    public function run(): void
    {
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::Weightlifting->value],
            ['name' => 'Weightlifting', 'json_template' => '[]', 'description' => 'Bodybuilding and Power-Lifting exercises']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::OlympicLifting->value],
            ['name' => 'Olympic Lifting', 'json_template' => '[]', 'description' => 'Snatch, Clean & Jerk, etc.']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::Strongman->value],
            ['name' => 'Strongman', 'json_template' => '[]', 'description' => 'Atlas Stones, Tire Flips, etc.']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::Calisthenics->value],
            ['name' => 'Calisthenics', 'json_template' => '[]', 'description' => 'Bodyweight exercises']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::Plyometrics->value],
            ['name' => 'Plyometrics', 'json_template' => '[]', 'description' => 'Box Jumps, Jump Squats, etc.']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::Stretching->value],
            ['name' => 'Stretching', 'json_template' => '[]', 'description' => 'Static, Dynamic, PNF, etc.']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::EnduranceTraining->value],
            ['name' => 'Endurance Training', 'json_template' => '[]', 'description' => 'All Forms of Cardio']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::PhysicalExercises->value],
            ['name' => 'Physical Exercises', 'json_template' => '[]', 'description' => 'Yoga, Pilates, Calisthenics, Courses, etc.']
        );
        ExerciseCategory::updateOrCreate(
            ['id' => EnumExerciseCategory::OtherActivities->value],
            ['name' => 'Other Activities', 'json_template' => '[]', 'description' => 'Hiking, Swimming, Bouldering, Outdoor, etc.']
        );
    }
}
