<?php

namespace App\Common\Enums;

enum EnumExerciseCategory: int
{
    case Weightlifting = 1;         // Bodybuilding and Power-Lifting exercises
    case OlympicLifting = 2;        // Snatch, Clean & Jerk, etc.
    case Strongman = 3;             // Atlas Stones, Tire Flips, etc.
    case Calisthenics = 4;          // Bodyweight exercises
    case Plyometrics = 5;           // Box Jumps, Jump Squats, etc.
    case Stretching = 6;            // Static, Dynamic, PNF, etc.
    case EnduranceTraining = 7;     // All Forms of Cardio
    case PhysicalExercises = 8;     // Yoga, Pilates, Courses, etc.
    case OtherActivities = 9;       // Hiking, Swimming, Bouldering, Outdoor, etc.

    // Get Key-Value Pairs with simple Acronyms for each category
    // Example: EnumExerciseCategory::Weightlifting => 'WL'
    public static function getAcronym(EnumExerciseCategory $category): string
    {
        return match ($category) {
            EnumExerciseCategory::Weightlifting => 'WL',
            EnumExerciseCategory::OlympicLifting => 'OL',
            EnumExerciseCategory::Strongman => 'SM',
            EnumExerciseCategory::Calisthenics => 'CS',
            EnumExerciseCategory::Plyometrics => 'PL',
            EnumExerciseCategory::Stretching => 'ST',
            EnumExerciseCategory::EnduranceTraining => 'ET',
            EnumExerciseCategory::PhysicalExercises => 'PE',
            EnumExerciseCategory::OtherActivities => 'OA',
        };
    }

    public static function getAcronymByKey(int $key): string
    {
        return self::getAcronym(self::from($key));
    }
}
