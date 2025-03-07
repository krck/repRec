<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateExerciseRequest;
use App\Http\Requests\StoreExerciseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\ExerciseCategory;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    /**
     * GET /exercise
     * Return a view that lists all exercises
     */
    public function index(): View
    {
        // Query all exercises and group them by category
        // (where the group MUST retain the Exercise Model instance)
        $exercises = Exercise::with('exercise_category')->get();
        $exerciseGroups = [];
        foreach ($exercises as $exercise) {
            $exerciseGroups[$exercise->exercise_category->name][] = $exercise;
        }

        // Transform the map into a view-friendly format 
        // (where key / category-name can be accessed easily)
        $viewExerciseGroups = [];
        foreach ($exerciseGroups as $key => $value) {
            $viewExerciseGroups[] = ['name' => $key, 'exercises' => $value];
        }

        return view('exercise.index', data: ['exerciseGroups' => $viewExerciseGroups]);
    }

    /**
     * GET /exercise/create
     * Return a view that with all input fields to create a new exercise
     */
    public function create(): View
    {
        $exerciseCategories = ExerciseCategory::all()->sortBy('id');
        return view('exercise.create', data: ['exerciseCategories' => $exerciseCategories]);
    }
    // POST /exercise
    public function store(StoreExerciseRequest $request): RedirectResponse
    {
        // Good to know: Get values without validation
        // $request('name');
        // $request->all();

        // Create a new exercise
        Exercise::create($request->validated());
        return redirect()->route('exercise.index');
    }

    /**
     * GET /exercise/{exercise}/edit
     * Return a view that with all input fields to edit an existing exercise
     */
    public function edit(Exercise $exercise)
    {
        $exerciseCategories = ExerciseCategory::all()->sortBy('id');
        return view('exercise.edit', data: [
            'exercise' => $exercise,
            'exerciseCategories' => $exerciseCategories
        ]);
    }
    // PATCH /exercise/{exercise}
    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        // Update the validated exercise
        $exercise->update($request->validated());
        return redirect()->route('exercise.index');
    }

    /**
     * DELETE /exercise/{id}
     */
    public function destroy($id)
    {
        // Delete the exercise
        $exercise = Exercise::find($id);
        $exercise->delete();
        return redirect()->route('exercise.index');
    }

}
