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
    case PhysicalExercises = 8;     // Yoga, Pilates, Calisthenics, Courses, etc.
    case OtherActivities = 9;       // Hiking, Swimming, Bouldering, Outdoor, etc.
}
