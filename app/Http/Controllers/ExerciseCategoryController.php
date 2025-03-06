<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateExerciseCategoryRequest;
use App\Http\Requests\StoreExerciseCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\ExerciseCategory;

class ExerciseCategoryController extends Controller
{
    /**
     * GET /exercise-category
     * Return a view that lists all exercise categories
     */
    public function index(): View
    {
        $exerciseCategories = ExerciseCategory::all()->sortBy('id');
        return view('exercise-category.index', data: ['exerciseCategories' => $exerciseCategories]);
    }

    /**
     * GET /exercise-category/create
     * Return a view that with all input fields to create a new exercise category
     */
    public function create(): View
    {
        return view('exercise-category.create', data: []);
    }
    // POST /exercise-category
    public function store(StoreExerciseCategoryRequest $request): RedirectResponse
    {
        // Good to know: Get values without validation
        // $request('name');
        // $request->all();

        // Create a new exercise category
        ExerciseCategory::create($request->validated());
        return redirect()->route('exercise-category.index');
    }

    /**
     * GET /exercise-category/{exerciseCategory}/edit
     * Return a view that with all input fields to edit an existing exercise category
     */
    public function edit(ExerciseCategory $exerciseCategory)
    {
        return view('exercise-category.edit', data: ['exerciseCategory' => $exerciseCategory]);
    }
    // PATCH /exercise-category/{exerciseCategory}
    public function update(UpdateExerciseCategoryRequest $request, ExerciseCategory $exerciseCategory)
    {
        // Update the validated exercise category
        $exerciseCategory->update($request->validated());
        return redirect()->route('exercise-category.index');
    }

    /**
     * DELETE /exercise-category/{exerciseCategory}
     */
    public function destroy(ExerciseCategory $exerciseCategory)
    {
        // Delete the exercise category
        $exerciseCategory->delete();
        return redirect()->route('exercise-category.index');
    }

}
