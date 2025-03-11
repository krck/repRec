<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePlanWorkoutExerciseRequest;
use App\Http\Requests\StorePlanWorkoutExerciseRequest;
use App\Models\PlanWorkoutExercise;
use App\Models\ExerciseCategory;
use App\Models\PlanWorkout;
use App\Models\Exercise;

class PlanWorkoutExerciseController extends Controller
{
    /**
     * GET /plan-workout-exercise/{planWorkoutId}
     * Return a view that lists all plan workout exercises for a given plan workout
     */
    public function index($planWorkoutId)
    {
        // Get Plan Workout by user_id and planWorkoutId
        $planWorkout = PlanWorkout::where([
            'user_id' => auth()->user()->id,
            'id' => $planWorkoutId
        ])->with('plan_workout_exercises')->first();

        return view('plan-workout-exercise.index', ['planWorkout' => $planWorkout]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($planWorkoutId)
    {
        // Get Plan Workout by user_id and planWorkoutId
        $planWorkout = PlanWorkout::where([
            'user_id' => auth()->user()->id,
            'id' => $planWorkoutId
        ])->with('plan_workout_exercises')->first();

        // Load additional Dropdown/Selection data
        $exerciseCategories = ExerciseCategory::select('id', 'name')->get();
        $exercises = Exercise::select('id', 'name', 'exercise_category_id')->get();

        return view('plan-workout-exercise.create', data: [
            'planWorkout' => $planWorkout,
            'exerciseCategories' => $exerciseCategories,
            'exercises' => $exercises
        ]);
    }
    public function store(StorePlanWorkoutExerciseRequest $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanWorkoutExercise $planWorkoutExercise)
    {
        //
    }
    public function update(UpdatePlanWorkoutExerciseRequest $request, PlanWorkoutExercise $planWorkoutExercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanWorkoutExercise $planWorkoutExercise)
    {
        //
    }
}
