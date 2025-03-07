<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'exercise_category_id' => 'required|integer',
            'name' => 'required|max:255',
            'primary_muscles' => 'required|max:255',
            'secondary_muscles' => 'nullable|max:255',
            'mechanic' => 'required|max:255',
            'level' => 'required|max:255',
            'force' => 'required|max:255',
            'equipment' => 'required|max:255',
            'instructions' => 'nullable',
        ];
    }
}
