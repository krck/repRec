<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePlanWorkoutRequest;
use App\Http\Requests\StorePlanWorkoutRequest;
use Illuminate\Contracts\View\View;
use App\Models\PlanWorkout;

class PlanWorkoutController extends Controller
{
    /**
     * GET /plan-workout
     * Return a view that lists all plan workouts for the user
     */
    public function index(): View
    {
        // Get Plan Workouts by user_id, based on the logged-in user
        $planWorkouts = PlanWorkout::where('user_id', auth()->id())->get()->sortByDesc('created_at');
        return view('plan-workout.index', ['planWorkouts' => $planWorkouts]);
    }

    /**
     * GET /plan-workout/create
     * Return a view that with all input fields to create a new plan workout
     */
    public function create()
    {
        return view('plan-workout.create', data: []);
    }
    // POST /plan-workout
    public function store(StorePlanWorkoutRequest $request)
    {
        // Get the validated data from the request
        // Add the user_id and set is_shared to false
        $newPlanWorkout = $request->validated();
        $newPlanWorkout['user_id'] = auth()->id();
        $newPlanWorkout['is_shared'] = false;

        PlanWorkout::create($newPlanWorkout);
        return redirect()->route('plan-workout.index');
    }

    /**
     * GET /plan-workout/{planWorkout}/edit
     * Return a view that with all input fields to edit an existing plan workout
     */
    public function edit(PlanWorkout $planWorkout)
    {
        return view('plan-workout.edit', data: ['planWorkout' => $planWorkout]);
    }
    // PATCH /plan-workout/{planWorkout}
    public function update(UpdatePlanWorkoutRequest $request, PlanWorkout $planWorkout)
    {
        // Update the validated plan workout
        $planWorkout->update($request->validated());
        return redirect()->route('plan-workout.index');
    }

    /**
     * DELETE /plan-workout/{id}
     */
    public function destroy($id)
    {
        // Delete the plan workout
        $planWorkout = PlanWorkout::find($id);
        $planWorkout->delete();
        return redirect()->route('plan-workout.index');
    }
}
