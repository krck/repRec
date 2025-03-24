<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents((env('APP_ENV', 'local') != 'local'
            ? '/var/www/repRec/database/backups/exercise_data.json'
            : '/home/peter/Projects/repRec/repRec/database/backups/exercise_data.json'
        ));

        // Decode JSON into an associative array (true -> returns array instead of object)
        $exercises = json_decode($json, true);
        foreach ($exercises as $exercise) {
            Exercise::updateOrCreate(
                ['id' => $exercise['Id']],
                [
                    'exercise_category_id' => $exercise['OptExerciseCategoryId'],
                    'name' => $exercise['Name'],
                    'primary_muscles' => $exercise['PrimaryMuscles'],
                    'secondary_muscles' => $exercise['SecondaryMuscles'],
                    'mechanic' => $exercise['Mechanic'],
                    'level' => $exercise['Level'],
                    'force' => $exercise['Force'],
                    'equipment' => $exercise['Equipment'],
                    'instructions' => $exercise['Instructions'],
                ]
            );
        }
    }
}
