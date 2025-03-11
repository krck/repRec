<x-app-layout>
    <x-slot:heading>
        Plan Workout Exercise
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Create From) -->
    <div class="slot-content">
        <form id="createPlanWorkoutExerciseForm" method="POST" action="{{ route('plan-workout-exercise.store') }}"
            x-data="{
                selectedCategory: '',
                exercises: [],
                get filteredExercises() {
                    if (!this.selectedCategory) return [];
                    return this.exercises.filter(ex => ex.exercise_category_id == this.selectedCategory);
                }
            }" x-init="exercises = {{ $exercises->toJson() }}">
            @csrf

            @php
                // Hardcoded dropdown values as variables
                $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            @endphp

            <!-- Exercise Category Select -->
            <x-form-input-select name="exercise_category_id" label="Exercise Category" :options="$exerciseCategories"
                x-model="selectedCategory" />
            <!-- Exercise Select (Filtered) -->
            <x-form-input-select name="exercise_id" label="Exercise">
                <template x-for="exercise in filteredExercises" :key="exercise . id">
                    <option :value="exercise . id" x-text="exercise.name"></option>
                </template>
            </x-form-input-select>
            <!-- Weekday -->
            <x-form-input-select name="day_index" label="Weekday" :options="$weekdays" />
            <!-- Description -->
            <x-form-input-textarea name="exercise_definition_json" label="Exercise Definition" placeholder="{}" />
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Save button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('plan-workout-exercise.index', $planWorkout->id) }}"
                class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="createPlanWorkoutExerciseForm" class="btn w-24 btn-primary">Save</button>
        </div>
    </div>

</x-app-layout>