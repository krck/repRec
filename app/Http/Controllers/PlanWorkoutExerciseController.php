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
        ])->first();

        $planWorkoutExercises = PlanWorkoutExercise::where([
            'user_id' => auth()->user()->id,
            'plan_workout_id' => $planWorkoutId
        ])->with('exercise')->get();

        return view('plan-workout-exercise.index', [
            'planWorkout' => $planWorkout,
            'planWorkoutExercises' => $planWorkoutExercises
        ]);
    }

    /**
     * GET /plan-workout-exercise/create/{planWorkoutId}
     * Return a view that with all input fields to create a new plan workout exercise
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
        $exercises = Exercise::select('id', 'name', 'exercise_category_id')->get()->sortBy('name');

        return view('plan-workout-exercise.create', data: [
            'planWorkout' => $planWorkout,
            'exerciseCategories' => $exerciseCategories,
            'exercises' => $exercises
        ]);
    }
    // POST /plan-workout-exercise/{planWorkoutId}
    public function store(StorePlanWorkoutExerciseRequest $request, $planWorkoutId)
    {
        // Get the validated data from the request
        // Add the user_id, plan_workout_id and day_order (last in the list)
        $newPlanWorkoutExercise = $request->validated();
        $newPlanWorkoutExercise['user_id'] = auth()->id();
        $newPlanWorkoutExercise['plan_workout_id'] = $planWorkoutId;
        $newPlanWorkoutExercise['day_order'] = 999;

        PlanWorkoutExercise::create($newPlanWorkoutExercise);
        return redirect()->route('plan-workout-exercise.index', $planWorkoutId);
    }


    /**
     * GET /plan-workout-exercise/{planWorkoutExercise}/edit
     * Return a view that with all input fields to edit an existing plan workout exercise
     */
    public function edit(PlanWorkoutExercise $planWorkoutExercise)
    {
        // Load additional Dropdown/Selection data
        $exerciseCategories = ExerciseCategory::select('id', 'name')->get();
        $exercises = Exercise::select('id', 'name', 'exercise_category_id')->get()->sortBy('name');

        return view('plan-workout-exercise.edit', data: [
            'planWorkoutExercise' => $planWorkoutExercise,
            'exerciseCategories' => $exerciseCategories,
            'exercises' => $exercises
        ]);
    }
    // PATCH /plan-workout-exercise/{planWorkoutExercise}
    public function update(UpdatePlanWorkoutExerciseRequest $request, PlanWorkoutExercise $planWorkoutExercise)
    {
        // Update the validated plan workout
        $planWorkoutExercise->update($request->validated());
        return redirect()->route('plan-workout-exercise.index', $planWorkoutExercise->plan_workout_id);
    }

    /**
     * DELETE /plan-workout-exercise/{id}
     */
    public function destroy($id)
    {
        // Delete the plan workout
        $planWorkoutExercise = PlanWorkoutExercise::find($id);
        $planWorkoutId = $planWorkoutExercise->plan_workout_id;
        $planWorkoutExercise->delete();
        return redirect()->route('plan-workout-exercise.index', $planWorkoutId);
    }
}
