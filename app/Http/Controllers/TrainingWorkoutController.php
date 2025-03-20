<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingWorkoutRequest;
use Illuminate\Contracts\View\View;
use App\Models\TrainingWorkout;
use Illuminate\Http\Request;

class TrainingWorkoutController extends Controller
{
    /**
     * GET /training-year
     * Return a yearly view of all the users training workouts
     */
    public function index(Request $request): View
    {
        // Get the year from the URL, if none is provided (e.g. on first load), use the current year
        $selectedYear = $request->input('year', date('Y'));

        // Get the last week of the year (simple hack - from this dates it can be 52, 53 or 01 - so get max)
        $lastWeek1 = date("W", strtotime($selectedYear . "-12-27"));
        $lastWeek2 = date("W", strtotime($selectedYear . "-12-29"));
        $lastWeek3 = date("W", strtotime($selectedYear . "-12-31"));
        $maxWeek = max($lastWeek1, $lastWeek2, $lastWeek3);

        return view('training-year.index', [
            'selectedYear' => $selectedYear,
            'maxWeek' => $maxWeek,
        ]);
    }

    /**
     * GET /training-year/create
     * Return a view that with all input fields to create a new training workout
     */
    public function create()
    {
        //
    }
    // POST /training-year
    public function store(StoreTrainingWorkoutRequest $request)
    {
        //
    }

    /**
     * DELETE /training-year/{id}
     */
    public function destroy(TrainingWorkout $trainingWorkout)
    {
        //
    }
}
